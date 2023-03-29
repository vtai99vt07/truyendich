<?php

namespace App\Http\Controllers\Shop;

use App\Domain\Chapter\Models\Chapter;
use App\Domain\Story\Models\StoryCategories;
use App\Domain\Story\Models\Story;
use App\Domain\Comment\Comment;
use App\Domain\Activity\Readed;
use App\Enums\StoryType;
use App\Events\ChapterViewed;
use App\Scraper\LeechTrxs;
use App\Scraper\LeechXinyushuwu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class ChapterController
{
    public function show(Story $story, Request $request)
    {

        $embed_link = $request->link;
        $id = $request->id;
        $chapter = null;
        $search_link = null;
        if (!$embed_link && !$id) {
            abort(404);
        }

        // get chapter
        if ($story->type == 1) {
            $chapters = json_decode($story->chapters_json, 1);
        } else {
            $chapters = $story->chapters;
        }
        if ($embed_link) { // embed chapter
            $search_link = false;
            foreach ($chapters as $key => $chap) {
                if (@$chap['embed_link'] && @$chap['embed_link'] == $embed_link) {
                    $search_link = $key;
                }
            }
            if ($search_link === false) {
                abort(404);
            }
            $chapter = Chapter::where('embed_link', $embed_link)->first();
//            if('https://wap.faloo.com/1012883_4.html' == $embed_link){
//                dd($chapter);
//            }
            if (!$chapter) {
                $chapter = $chapters[$search_link];
                $url = filter_var($embed_link, FILTER_VALIDATE_URL);
                $parse = parse_url($url);
                if (strpos($embed_link, 'xinyushuwu')) {
                    $embedChapter = new LeechXinyushuwu();
                    if ($embedChapter->scrapeChapter($story, $embed_link)) {
                        $chapter = Chapter::where('embed_link', $embed_link)->first();
                    } else {
                        dd('Không nhúng được');
                    }
                } elseif (strpos($embed_link, 'trxs')) {
                    $embedChapter = new LeechTrxs();
                    if ($embedChapter->scrapeChapter($story, $embed_link)) {
                        $chapter = Chapter::where('embed_link', $embed_link)->first();
                    } else {
                        dd('Không nhúng được');
                    }
                } else {
                    if ($parse) {
                        $base_url = $parse['scheme'] . '://' . $parse['host'];
                        $datahosts = Http::get("http://103.116.104.174:8000/gethost?link=$url")->json();
                        // dd($datahosts);
                        try{
                            $new_chap = [
                                'name' => $chapter['name'],
                                'story_id' => $chapter['story_id'],
                                'status' => $chapter['status'],
                                'order' => $chapter['order'],
                                'embed_link' => $url,
                                'is_vip' => (currentUser() && currentUser()->is_vip == 1) ? ($is_vip ?? 0) : 0,
                                'mod_id' => (currentUser() && currentUser()->is_vip == 1) ? (currentUser()->id) : null,
                                'host' => $datahosts['host'],
                                'idhost' => $datahosts['bookid'],
                                'idchap' => $datahosts['chapid'],
                            ];
                            $chapter = Chapter::create($new_chap);
                            // dd($chapter);
                            $chapters[$search_link] = $chapter->toArray();
                            $story->update(['chapters_json' => json_encode($chapters)]);
                            $chapter = embedChapter($url, $base_url, currentUser(), $chapter, $request->is_vip ?? 0) ?? $chapter;

                        }
                        catch (\Exception $e) {
                            dd('Không nhúng được');
                        }


                    } else {
                        dd('Không nhúng được');
                    }
                }
            }elseif(empty($chapter->content)){
                $url = filter_var($embed_link, FILTER_VALIDATE_URL);
                $parse = parse_url($url);
                if ($parse) {
                    $base_url = $parse['scheme'] . '://' . $parse['host'];
                    $datahosts = Http::get("http://103.116.104.174:8000/gethost?link=$url")->json();
                    if(isset($datahosts)&&isset($datahosts['bookid'])&&isset($datahosts['chapid'])){
                        $chapter = UpdateContentChapter($url, $base_url, $chapter) ?? $chapter;
                    }
                }
            }
        } else { // query chapter
            $chapter = Chapter::findOrFail($id);
            if(!currentUser() && $chapter->is_vip == 1){
                flash()->warning('Vui lòng đăng nhập để mua chương !');
                return back();
            }
        }

        if ($story->type == 1) {
            if ($search_link == null) {
                foreach ($chapters as $key => $chap) {
                    if (@$chap['id'] && $chap['id'] == $chapter['id']) {
                        $search_link = $key;
                    }
                }
            }
            $chapterPre = $chapters[$search_link - 1] ?? null;
            $chapterNext = $chapters[$search_link + 1] ?? null;
        } else {
            $chapterPre = Chapter::where('story_id', $story->id)->where('id', '<', $chapter->id)->orderBy('id', 'desc')->limit(1)->first();
            $chapterNext = Chapter::where('story_id', $story->id)->where('id', '>', $chapter->id)->orderBy('id', 'asc')->limit(1)->first();
        }

        $comment = Comment::where(['commentable_type' => 'App/Domain/Chapter/Models/Chapter',
            'commentable_id' => $chapter->id
        ])
            ->with('users', 'parents')
            ->orderBy('created_at', 'desc')
            ->get();
        $chapLastReaded = 0;
        if (!empty(currentUser()->id)) {
            $readed = Readed::where('user_id', currentUser()->id)->where('stories_id', $story->id)->first();
            if (!$readed) {
                $readed = Readed::create([
                    'stories_id' => $story->id,
                    'user_id' => currentUser()->id,
                    'chapters_id' => json_encode([$chapter->id]),
                    'source' => get_current_source()
                ]);
            } else {
                $chapters_readed = null;
                if ($readed->chapters_id) {
                    $chapters_readed = json_decode($readed->chapters_id, true);
                    $chapters_readed[] = $chapter->id;
                    $chapters_readed = array_unique($chapters_readed);
                }
                $readed->update(['chapters_id' => json_encode($chapters_readed)]);
            }
            $readeds = json_decode($readed->chapters_id, true);
            $chapLastReaded = !empty($readeds) ? Chapter::whereIn('id', $readeds)->orderBy('order', 'DESC')->first() : null;
        }

        $chapterLastReaded = $chapLastReaded ? (int)$chapLastReaded->order : '';
        $story->update([
            'view' => DB::raw('view + 1'),
            'view_day' => DB::raw('view_day + 1'),
            'view_week' => DB::raw('view_week + 1')
        ]);
        if(strcmp($story->origin,'uukanshu') == 1)
            $story->chapters =  array_reverse($story->chapters);
        ChapterViewed::dispatch($chapter);
//        $catStories = StoryCategories::where('stories_id', $story->id)->first() != NULL ? StoryCategories::where('stories_id', $story->id)->first() : '';
        $listRelated = Story::leftJoin('story_categories','stories.id','=','story_categories.stories_id')
            ->where('id','!=',$story->id)
            ->where('count_chapters','>',100)
            ->whereNull('story_categories.stories_id')
            ->orderBy('view_week','DESC')->limit(5)->get();
        return view('shop.chapter.show', [
            'comment' => $comment,
            'story' => $story,
            'chapter' => $chapter,
            'chapters' => $chapters,
            'chapterPre' => $chapterPre ?? null,
            'chapterNext' => $chapterNext ?? null,
            'chapLastReaded' => $chapLastReaded,
            'chapterLastReaded' => $chapterLastReaded,
            'listRelated' => $listRelated
        ]);
    }
}

<?php

use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Support\Str;
use App\Domain\Story\Models\Story;
use Illuminate\Support\Collection;
use App\Domain\Admin\Models\Donate;
use App\Domain\Admin\Models\Wallet;
use App\Support\ValuesStore\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Domain\Chapter\Models\Chapter;
use App\Domain\Category\Models\Category;
use Symfony\Component\DomCrawler\Crawler;
use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('array_reset_index')) {
    /**
     * Reset numeric index of an array recursively.
     *
     * @param array $array
     * @return array|\Illuminate\Support\Collection
     *
     * @see https://stackoverflow.com/a/12399408/5736257
     */
    function array_reset_index($array): array
    {
        $array = $array instanceof Collection
            ? $array->toArray()
            : $array;

        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $array[$key] = array_reset_index($val);
            }
        }

        if (isset($key) && is_numeric($key)) {
            return array_values($array);
        }

        return $array;
    }
}
if (!function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        if ($key === null) {
            return app(Setting::class);
        }

        return app(Setting::class)->get($key, $default);
    }
}

if (!function_exists('randCode')) {
    function randCode($db, $column): string
    {
        $latestTransaction = $db::latest($column)->where($column, 'like', 'NT-%')->first();
        if ($latestTransaction) {
            preg_match('/[\d]+/', $latestTransaction->$column, $pre);

            $pre = (int) $pre[0];

            $newTransaction = 'NT-' . str_pad($pre + 1, 6, "0", STR_PAD_LEFT);
        } else {
            $newTransaction = 'NT-' . str_pad(1, 6, "0", STR_PAD_LEFT);
        }
        //$newTransaction = Str::orderedUuid()->toString();
        return $newTransaction;
    }
}

if (!function_exists('formatDatetimetoGmt')){
    function formatDatetimetoGmt($date,$format = 'Y-m-d H:i:s'):string
    {
        $tz1 = 'GMT';
        $tz2 = 'Asia/Ho_Chi_Minh'; // GMT +7

        $d = new DateTime($date, new DateTimeZone($tz1));
        $d->setTimeZone(new DateTimeZone($tz2));

        return $d->format($format);

    }
}

if (!function_exists('formatDate')) {
    function formatDate($date): string
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
        }

        return $date->format(setting('date_format', 'Y-m-d H:i:s'));
    }
}
if (!function_exists('formatDay')) {
    function formatDay($date): string
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
        }

        return $date->format(setting('date_format', 'Y-m-d'));
    }
}

if (!function_exists('formatYear')) {
    function formatYear($date): string
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::createFromFormat('Y', $date);
        }

        return $date->format(setting('date_format', 'Y'));
    }
}

if (!function_exists('formatHours')) {
    function formatHours($date): string
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::createFromFormat('H', $date);
        }

        return $date->format(setting('date_format', 'H'));
    }
}

if (!function_exists('formatDayMonthYear')) {
    function formatDayMonthYear($date): string
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
        }

        return $date->format('d-m-Y');
    }
}

if (!function_exists('intended')) {
    function intended($request, string $defaultUrl)
    {
        if (!empty($request->redirect_url)) {
            return redirect($request->redirect_url);
        }

        return redirect()->to($defaultUrl);
    }
}

function formatNumber($value)
{
    return number_format($value);
}

if (!function_exists('currentUser')) {
    function currentUser()
    {
        return Auth::guard('web')->user();
    }
}

if (!function_exists('currentAdmin')) {
    function currentAdmin()
    {
        return Auth::guard('admins')->user();
    }
}

if (!function_exists('logActivity')) {
    function logActivity($subjectModel, $actionName, $customProperties = [])
    {
        $activity = activity();
        $activity->causedBy(auth()->user());
        if ($subjectModel) {
            $activity->performedOn($subjectModel);
        }
        if (!empty($customProperties)) {
            $activity->withProperties($customProperties);
        }
        $activity->log($actionName);
        return $activity;
    }
}
if (!function_exists('site_get_mail_template')) {
    function site_get_mail_template($slug)
    {
        $option = \DB::table('mail_settings')
            ->where([
                ['slug', $slug],
            ])
            ->first();

        if (!empty($option->value)) {
            return !is_array($option->value) ? \json_decode($option->value, true) : $option->value;
        }
        return [];
    }
}

function LuatNhan()
{
    return readDictionary('LuatNhan');
}

function Names()
{
    return readDictionary('Names');
}

function VietPhrase()
{
    return readDictionary('VietPhrase');
}

function LacViet()
{
    return readDictionary('LacViet');
}

function readDictionary($fileName)
{
    $content = [];
    foreach (file(public_path() . '/dictionary/' . $fileName . '.txt') as $value) {
        $value_array = explode('=', trim($value));
        if (count($value_array) > 1) {
            $content[$value_array[0]] = $value_array[1];
        }
    }

    return $content;
}

function formatChineString($chinese)
{
    $new_text = '';
    preg_match_all('/./u', $chinese, $characters);
    foreach ($characters[0] as $key => $character) {
        if (is_numeric($character) && !is_numeric(@$characters[0][$key + 1])) {
            $new_text .= $character . ' ';
        } elseif ($key != count($characters[0]) - 1 && !is_numeric($character) && is_numeric(@$characters[0][$key + 1])) {
            $new_text .= $character . ' ';
        } else {
            $new_text .= $character;
        }
    }

    return $new_text;
}

function searchDirectory($primary_directory, $directory, $chinese)
{
    $chinese = handleLuatNhan($chinese);
    $result = '';
    $start = 0;
    $end = mb_strlen($chinese);
    while ($start < $end) {
        for ($j = $end; $j > 0; $j--) {
            $sub_string = mb_substr($chinese, $start, $j);
            $search = @$primary_directory[$sub_string] ?? @$directory[$sub_string];
            if ($search) {
                $result .= explode('/', $search)[0] . ' ';
                $start += mb_strlen($sub_string);
            }
            if ((mb_strlen($sub_string) == 1) && $search == null) {
                if (preg_match("/\p{Han}+/u", $sub_string)) {
                    //                    $sub_string = GoogleTranslate::trans($sub_string, 'vi', 'zh-TW') . ' ';
                }
                $result .= $sub_string;
                $start++;
            }
        }
    }

    return $result;
}

function handleLuatNhan($a)
{
    $dictionary = LuatNhan();
    $target = null;
    $target_begin = null;
    $key_result = '';
    $word_target = '';

    foreach ($dictionary as $b => $value) {
        if (mb_strpos($b, '{0}') === 0) {
            $key = str_replace('{0}', '', $b);
            if (mb_strpos($a, $key) !== false) {
                $key_result = $b;
                $target = 0;
                $target_begin = mb_strpos($a, $key) != -1 ? mb_strpos($a, $key) + 1 : -1;
                break;
            }
        } elseif (mb_strpos($b, '{0}') == (mb_strlen($b) - 3)) {
            $key = str_replace('{0}', '', $b);
            if (mb_strpos($a, $key) !== false) {
                $key_result = $b;
                $target = mb_strlen($key) + mb_strpos($a, $key);
                $target_begin = mb_strpos($a, $key) != -1 ? mb_strlen($a) - mb_strlen($key) + 1 + $target : -1;
                break;
            }
        } else {
            $biensosanh = explode('{0}', $b);
            if (mb_strpos($a, $biensosanh[0]) !== false) {
                $target = mb_strlen($biensosanh[0]) + mb_strpos($a, $biensosanh[0]);
                if (mb_strpos(mb_substr($a, $target), $biensosanh[1]) !== false) {
                    $target_begin = mb_strpos($a, $biensosanh[0]);
                    $key_result = $b;
                    break;
                } else {
                    $target = -1;
                }
            }
        }
        if ($key_result) {
            break;
        }
    }

    if ($target !== null && $target != -1) {
        $word_target = mb_substr($a, $target, $target_begin - $target - 1);
    }

    if ($key_result) {
        $result = $dictionary[$key_result];
        $translated = str_replace('{0}', $word_target, $result);
        return str_replace(str_replace('{0}', $word_target, $key_result), $translated, $a);
    } else {
        return $a;
    }
}

if (!function_exists('upload_image')) {
    /**
     * @param $file [tên file trùng tên input]
     * @param array $extend [ định dạng file có thể upload được]
     * @return array|int [ tham số trả về là 1 mảng - nếu lỗi trả về int ]
     */
    function upload_image($file, $folder = '', array $extend = array())
    {
        $code = 1;
        // lay duong dan anh
        $baseFilename = public_path() . '/uploads/' . $_FILES[$file]['name'];

        // thong tin file
        $info = new SplFileInfo($baseFilename);

        // duoi file
        $ext = strtolower($info->getExtension());

        // kiem tra dinh dang file
        if (!$extend)
            $extend = ['png', 'jpg', 'jpeg', 'webp'];

        if (!in_array($ext, $extend))
            return $data['code'] = 0;

        // Tên file mới
        $nameFile = trim(str_replace('.' . $ext, '', strtolower($info->getFilename())));
        $filename = \Illuminate\Support\Str::slug($nameFile) . '.' . $ext;;

        // thu muc goc de upload
        $path = public_path() . '/uploads/';
        if ($folder)
            $path = public_path() . '/uploads/' . $folder . '/';

        if (!\File::exists($path))
            mkdir($path, 0777, true);

        // di chuyen file vao thu muc uploads
        move_uploaded_file($_FILES[$file]['tmp_name'], $path . $filename);

        $data = [
            'name' => $filename,
            'code' => $code,
            'path' => $path,
            'path_img' => 'uploads/' . $filename
        ];

        return $data;
    }
}
if (!function_exists('pare_url_file')) {
    function pare_url_file($image, $folder = '')
    {
        if (substr($image, 0, 4) == 'http')
            return $image;
        if ($folder != '')
            return '/uploads/' . $folder . '/' . $image;
        if ($folder == '')
            return '/uploads/' . $image;
    }
}

function translated($text = null)
{
    if (!$text) {
        return '';
    }

    $VietPhrase = VietPhrase();
    $Names = Names();
    preg_match_all('/(\w+)|(.)/u', $text, $sentences);
    $translated = '';

    foreach ($sentences[0] as $sentence) {
        $sentence = formatChineString($sentence);
        $translated .= searchDirectory($Names, $VietPhrase, $sentence);
    }
    return $translated;
}

function embedStoryUukanshu($url, $base_url, $user, $story = false, $returnBool = false)
{

    $data = Http::get("http://103.116.104.174:8000/getlink?link=$url")->json();
    if (!$data) {
        if ($returnBool) {
            return false;
        } else {
            dd('Không nhúng được hoặc host không hỗ trợ');
        }
    }

    $title = [];
    $story_name = $data['name'];

    if (!$story && checkExistStory($story_name, $url, $user)) {
        return true;
    }

    $story_description = _vp_viet($data['gioithieu']);
    $avatar = $data['img'];
    $breadcrums = [];
    $categories = [];
    $tags = [];
    $author = $data['tacgia'];
    $author_vi = _vp_viet($author);
    $story_name_vi = _vp_viet($story_name);
    $breadcrums[] = $data['theloai'];
    $bookid = $data['bookid'];
    $host = $data['host'];
    if (!empty($breadcrums)) {
        foreach ($breadcrums as $key => $breadcrum) {
//            if ($key > 1) {
            $categories[] = $breadcrum;
//            }
        }
    }

    if (!empty($data['tag'])) {
        foreach ($data['tag'] as $tag) {
            $tags[] = _vp_viet($tag);
        }
    }

    $chapter_names = '';

    foreach ($data['listchap'] as $chap) {
        if ($chap['vip'] == false) {
            $title[] = $chap['linkchap'];
            if (empty($chapter_names)) {
                $chapter_names .= $chap['namechap'];
            } else {
                $chapter_names .= '|' . $chap['namechap'];
            }
        }
    }

    if (!empty($title) && $story_name) {
        if ($story) {

            updateEmbedStory($title, $story, $chapter_names);

            return true;
        }



        storeStory($title, $story_name, $categories, $story_name_vi, $story_description, $url, $avatar, $author, $author_vi, $user, $chapter_names, $bookid, $host, $tags);
    }

    return true;
}







function storeStory($title, $story_name, $categories, $story_name_vi, $story_description, $url, $avatar, $author, $author_vi, $user, $chapter_names, $bookid, $host, $tags = [])
{
    $cat = [];
    if (!empty($categories)) {
        foreach ($categories as $category) {
            $cat_db = Category::where('status', Category::ACTIVE)->where('name_chines', 'like', '%' . $category . '%');
            if (!$cat_db->exists()) {
                $c_viet = _vp_viet($category);
                $cat_db = Category::where('status', Category::ACTIVE)->where('name', 'like', $c_viet);
                if (!$cat_db->exists()) {
                    $cat_db = Category::create([
                        'name' => $c_viet,
                        'status' => Category::ACTIVE,
                        'name_chines' => json_encode([
                            $category
                        ])
                    ]);
                } else {
                    $name_chines = json_decode($cat_db->name_chines, true);
                    $name_chines[] = $category;
                    $cat_db = $cat_db->first();
                    $cat_db->update([
                        'name_chines' => json_encode($name_chines)
                    ]);
                }
            } else {
                $cat_db = $cat_db->first();
            }
            $cat[] = $cat_db->id;
        }
    }

    $story = Story::updateOrCreate([
        'name' => $story_name_vi,

        'description' => $story_description,
        'user_id' => $user->id ?? 0,
        'type' => 1,
        'donate' => 0,
        'status' => 1,
        'is_vip' => 1,
        'origin' => $url,
        'avatar' => $avatar,
        'author' => $author,
        'author_vi' => $author_vi,
        'name_chines' => $story_name,
        'tags' => json_encode($tags),
        'idhost' => $bookid,
        'host' => $host,
        'chapter_updated' => Carbon::now(),
    ]);
    if ($user->is_vip && !$story->mod_id) {
        $story->mod_id = $user->id;
        $story->save();
    }

    $story->categories()->sync(array_unique($cat));

    $chapters = [];
    $chapter_names = explode('|', _vp_viet($chapter_names));
    $order =  1;
    foreach ($title as $key => $link) {
        $chapters[] = [
            'story_id' => $story->id,
            'name' => $chapter_names[$key],
            'embed_link' => $link,
            'status' => Chapter::ACTIVE,
            'order' => $order++
        ];
    }

    $story->chapters_json = json_encode($chapters);
    $story->save();

    $countChapters = count(collect(json_decode($story->chapters_json, 1)));
    $story->update([
        'count_chapters' => $countChapters
    ]);
    if (strpos($url, 'sangtacviet')||strpos($url, 'fanqie.com')||strpos($url, 'uukanshu.com')) {
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $charater = $user->get_charaters;
            if ($charater) {

                $charater->increment('exp', 15);
            }
        }
    }
    return true;
}

function updateEmbedStory($title, $story, $chapter_names)
{
    if ($story->complete_free == Story::COMPLETE_FREE_ACTIVE) {
        return true;
    }

    $total = $story->count_chapters;
    $newtotal = sizeof($title);
    if ($total >= $newtotal) {

        return true;
    }

    $chapter_names = explode('|', _vp_viet($chapter_names));
    $chapters = [];
    $order =  1;
    foreach ($title as $key => $link) {
        $chapters[] = [
            'story_id' => $story->id,
            'name' => $chapter_names[$key],
            'embed_link' => $link,
            'status' => Chapter::ACTIVE,
            'order' => $order++

        ];
    }
    $story->chapters_json = json_encode($chapters);
    $story->chapter_updated = Carbon::now();
    $story->save();

    return true;
}


function checkExistStory($story_name, $url, $user)
{


    $datahost = Http::get("http://103.116.104.174:8000/gethost?link=$url")->json();

    $story = Story::where('idhost', $datahost['bookid'])->where('host', $datahost['host'])->first();
    // $datahost = Http::get("http://103.116.104.174:8000/gethost?link=$url")->json();
    if ($story) {


        $story->origin = $url;
        if ($user->is_vip && !$story->mod_id) {
            $wallet = Wallet::where('user_id', $user->id)->first();
            $wallet->silver = $wallet->silver + $story->donate * 10 - $story->donate * 15 / 10;
            $wallet->update();
            $story->mod_id = $user->id;
            $story->save();
        }
        if (empty($story->idhost)) {


            $datahosts = Http::get("http://103.116.104.174:8000/gethost?link=$story->origin")->json();


            if ($story->idhost != $datahosts['bookid']) {
                $story->idhost = $datahosts['bookid'];
                $story->host = $datahosts['host'];
                $story->save();
                return false;
            }
        }


        return redirect()->route('story.show', $story);
    } else {

        if (isset($datahost) && isset($datahost['bookid']) && isset($datahost['host'])) {
            $story = Story::where([['idhost', '=', $datahost['bookid']], ['host', '=', $datahost['host']]])->first();
            if ($story) {
                return redirect()->route('story.show', $story);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    return false;
}

function embedChapter($url, $base_url, $user, $chapter, $is_vip)
{
    $data = Http::get("http://103.116.104.174:8000/getlink?link=$url")->json();
    $content = $data['content'];
    $content = strip_tags($content, array('<i>', '<br>', '<p>'));

    if (!strpos($url, 'sangtacviet')) {

        $content = translate(trim($content));
    }

    if ($content) {
        $chapter->update([
            'name' => $chapter['name'],
            'story_id' => $chapter['story_id'],
            'status' => $chapter['status'],
            'order' => $chapter['order'],
            'content' => $content,
            'embed_link' => $url,
            'is_vip' => ($user && $user->is_vip == 1) ? ($is_vip ?? 0) : 0,
            'mod_id' => ($user && $user->is_vip == 1) ? ($user->id) : null,
            'host' => $data['host'],
            'idhost' => $data['bookid'],
            'idchap' => $data['chapid'],
        ]);

        return $chapter;
    }

    return false;
}

function UpdateContentChapter($url, $base_url, $chapter)
{
    $data = Http::get("http://103.116.104.174:8000/getlink?link=$url")->json();
    $content = $data['content'];

    $content = strip_tags($content, array('<i>', '<br>', '<p>'));
    if (!strpos($url, 'sangtacviet')) {
        // $content = strip_tags($content, array('<br>', '<p>'));
        $content = translate(trim($content));
    }
    if ($content) {
        $chapter->update([
            'content' => $content,
        ]);
        return $chapter;
    }

    return false;
}

function _vp_viet($text)
{
    //trả về tiếng việt 1 nghĩa
    return _api_dich($text);
}

function _vp_han($text)
{
    //trả về hán việt
    $text = "h" . $text;
    return _api_dich($text);
}

function translate($text)
{
    //trả về tiếng việt trong thẻ <i>
    $text = "i" . $text;
    return _api_dich($text);
}

function _api_dich($text)
{
    $text = "giangthe.com" . $text;
    $opts = array(
        'http' =>
            array(
                'timeout' => 10,
                'method' => 'POST',
                'header' => 'Content-Type: text/plain\r\nContent-Length: ' . strlen($text),
                'content' => $text
            )
    );
    $text_trans = stream_context_create($opts);
    return file_get_contents('http://103.116.104.174:12323/api/trans', false, $text_trans);
}

function _utf8($text)
{
    return mb_convert_encoding($text, 'UTF-8', 'GB18030');
}
if (!function_exists('random_float')) {
    function random_float($min, $max)
    {
        return round(($min + lcg_value() * (abs($max - $min))), 2);
    }
}

if (!function_exists('translateArray')) {
    /**
     * Translate string in array not timeout
     *
     * @param $list
     * @return array
     */
    function translateArray($list = [])
    {
        foreach ($list as &$item) {
            $item = implode('\\ ', array_map(
                function ($v, $k) {
                    if(is_array($v)){
                        return $k.'[]='.implode('&'.$k.'[]=', $v);
                    }else{
                        return $k.'='.$v;
                    }
                },
                $item,
                array_keys($item)
            ));
        }
        $list = implode("|", $list);
        $list = _vp_viet($list);
        $list = explode('|', $list);
        $result = [];
        foreach ($list as &$item) {
            $item = explode('\\ ', $item);
            $value = [];
            foreach ($item as &$i) {
                $i = explode('=', $i);
                $value[$i[0]] = $i[1];
            }
            $result[] = $value;
        }
        return $result;
    }
}

if (!function_exists('get_current_source')) {
    function get_current_source() {
        foreach (Story::SOURCE as $source) {
            if (strpos(url()->current(), $source)) {
                return $source;
            }
        }
        return false;
    }
}

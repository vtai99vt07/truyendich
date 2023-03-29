<?php

namespace App\Http\Controllers\User;

use App\Domain\Chapter\Models\Chapter;
use App\Domain\Category\Models\Category;
use App\Domain\Story\Models\Story;
use App\Domain\Type\Models\Type;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Doctrine\Common\Cache\Psr6\get;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::where('user_id', currentUser()->id)->where('type', 0)->withCount('chapters')->orderBy('updated_at','desc')->paginate(50);
        return view('shop.user.stories.index', [
            'stories' => $stories
        ]);
    }

    public function create()
    {
        $types = Type::where('status', Type::ACTIVE)->get();
        $categories = Category::where('status', Category::ACTIVE)->get();
        return view('shop.user.stories.create', [
            'types' => $types,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $story = Story::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'user_id' => currentUser()->id,
                    'status' => $request->status,
                    'donate' => '0',
		'mod_id' => currentUser()->id,
                ]);

                // Thêm ảnh
                if ($request->hasFile('file')) {
                    $story->addMedia($request->file)->toMediaCollection();
                }
                $story->types()->sync($request->types);
                $story->categories()->sync($request->categories);

                flash()->success(__('Truyện ":name" đã được tạo', ['name' => $story->name]));
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with(['message' => $e->getMessage()]);
        }
        return redirect()->route('stories.index');
    }

    public function edit(Story $story)
    {
        $types = Type::where('status', Type::ACTIVE)->get();
        $categories = Category::where('status', Category::ACTIVE)->get();
        return view('shop.user.stories.edit', [
            'types' => $types,
            'categories' => $categories,
            'story' => $story,
        ]);
    }

    public function update(Request $request, Story $story)
    {
        try {
            DB::transaction(function () use ($request, $story) {
                $story->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'user_id' => currentUser()->id,
                    'status' => $request->status,
                ]);

                $story->types()->sync($request->types);
                $story->categories()->sync($request->categories);
                // Thêm ảnh
                if ($request->hasFile('file')) {
                    foreach ($story->getMedia() as $media) {
                        $media->delete();
                    }
                    $story->addMedia($request->file)->toMediaCollection();
                }

                flash()->success(__('Truyện ":name" đã được tạo', ['name' => $story->name]));
            });
        } catch (\Exception $e) {
            return back()->with(['message' => $e->getMessage()]);
        }
        if ($story->type == 1) {
            return redirect()->route('book.nhungs');
        }
        return redirect()->route('stories.index');
    }

    public function delete(Story $story)
    {
        $story->chapters()->delete();
        $story->delete();

        return response()->json([
            'success' => true,
            'message' => __('Truyện đã được xóa thành công!'),
        ]);
    }

    public function updateCompleteFree(Story $story)
    {
        $story->update(['complete_free' => Story::COMPLETE_FREE_ACTIVE]);

        return response()->json([
            'status' => true,
            'message' => __('Đã cập nhật trạng thái thành công !'),
        ]);
    }
}

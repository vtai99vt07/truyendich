<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\DataTables\PostDataTable;
use App\Domain\Post\Models\Post;
use App\Http\Requests\Admin\PostBulkDeleteRequest;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Http\Requests\Admin\PostUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PostController
{
    use AuthorizesRequests;

    public function index(PostDataTable $dataTable)
    {
        $this->authorize('view', Post::class);

        return $dataTable->render('admin.posts.index');
    }

    public function create(): View
    {
        $this->authorize('create', Post::class);
//        $selectedRelatePost = [];
//        $relatedPosts = Post::get(['id', 'title']);

        return view('admin.posts.create');
    }

    public function store(PostStoreRequest $request)
    {
        $this->authorize('create', Post::class);
        $data = $request->except(['category', 'image', 'proengsoft_jsvalidation', 'redirect_url']);
        $data['user_id'] = auth('admins')->user()->id;
        $post = Post::create($data);

//        if ($request->hasFile('image')) {
//            $post->addMedia($request->image)->toMediaCollection('image');
//        }
        flash()->success(__('Bài viết ":model" đã được tạo thành công !', ['model' => $post->title]));

        logActivity($post, 'create'); // log activity

        return intended($request, route('admin.posts.index'));
    }

    public function edit(Post $post): View
    {
        $this->authorize('update', $post);
//        $relatedPosts = Post::get(['id', 'title']);
//        $selectedRelatePost = [];
//        if (!empty($post->related_posts)){
//            $selectedRelatePost = Post::query()
//                ->whereIntegerInRaw('id', $post->related_posts)
//                ->pluck('id')
//                ->toArray();
//        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        $this->authorize('update', $post);

//        if ($request->hasFile('image')) {
//            $post->addMedia($request->image)->toMediaCollection('image');
//        }

        $post->update($request->except(['proengsoft_jsvalidation', 'redirect_url']));

        flash()->success(__('Bài viết ":model" đã được cập nhật !', ['model' => $post->title]));

        logActivity($post, 'update'); // log activity

        return intended($request, route('admin.posts.index'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        if (\App\Enums\PostState::Active == $post->status) {
            return response()->json([
                'status' => 'error',
                'message' => __('Bài viết đang được sử dụng không thể xoá!'),
            ]);
        }
        logActivity($post, 'delete'); // log activity

        $post->delete();

        return response()->json([
            'status' => true,
            'message' => __('Bài viết đã xóa thành công !'),
        ]);
    }

    public function bulkDelete(PostBulkDeleteRequest $request)
    {
        $count_deleted = 0;
        $deletedRecord = Post::whereIn('id', $request->input('id'))->get();
        foreach ($deletedRecord as $post) {
            if (\App\Enums\PostState::Active != $post->status) {
                logActivity($post, 'delete'); // log activity
                $post->delete();
                $count_deleted++;
            }
        }
        return response()->json([
            'status' => true,
            'message' => __('Đã xóa ":count" bài viết thành công và ":count_fail" bài viết đang được sử dụng, không thể xoá',
                [
                    'count' => $count_deleted,
                    'count_fail' => count($request->input('id')) - $count_deleted,
                ]),
        ]);
    }

    public function changeStatus(Post $post, Request $request)
    {
        $this->authorize('update', $post);

        $post->update(['status' => $request->status]);

        logActivity($post, 'update'); // log activity

        return response()->json([
            'status' => true,
            'message' => __('Bài viết đã được cập nhật trạng thái thành công !'),
        ]);
    }

    public function bulkStatus(Request $request)
    {
        $total = Post::whereIn('id', $request->id)->get();
        foreach ($total as $post)
        {
            $post->update(['status' => $request->status]);
            logActivity($post, 'update'); // log activity
        }

        return response()->json([
            'status' => true,
            'message' => __(':count bài viết đã được cập nhật trạng thái thành công !', ['count' => $total->count()]),
        ]);
    }

    public function upLoadFileImage(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => ['mimes:jpeg,jpg,png', 'required', 'max:2048'],
            ],
            [
                'file.mimes' => __('Tệp tải lên không hợp lệ'),
                'file.max' => __('Tệp quá lớn'),
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('file'),
            ], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $file = $request->file('file')->storePublicly('tmp/uploads');

        return response()->json([
            'file' => $file,
            'status' => true,
        ]);
    }
}

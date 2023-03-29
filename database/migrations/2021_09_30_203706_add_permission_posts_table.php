<?php

use App\Domain\Acl\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissionPostsTable extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'posts.view',
                'en' => ['display_name' => 'View Post'],
                'vi' => ['display_name' => 'Xem bài viết'],
            ],
            [
                'name' => 'posts.create',
                'en' => ['display_name' => 'Create Post'],
                'vi' => ['display_name' => 'Thêm bài viết'],
            ],
            [
                'name' => 'posts.update',
                'en' => ['display_name' => 'Update Post'],
                'vi' => ['display_name' => 'Cập nhật bài viết'],
            ],
            [
                'name' => 'posts.delete',
                'en' => ['display_name' => 'Delete Post'],
                'vi' => ['display_name' => 'Xóa bài viết'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }

    public function down()
    {
        $permissions = [
            [
                'name' => 'posts.view',
                'en' => ['display_name' => 'View Post'],
                'vi' => ['display_name' => 'Xem bài viết'],
            ],
            [
                'name' => 'posts.create',
                'en' => ['display_name' => 'Create Post'],
                'vi' => ['display_name' => 'Thêm bài viết'],
            ],
            [
                'name' => 'posts.update',
                'en' => ['display_name' => 'Update Post'],
                'vi' => ['display_name' => 'Cập nhật bài viết'],
            ],
            [
                'name' => 'posts.delete',
                'en' => ['display_name' => 'Delete Post'],
                'vi' => ['display_name' => 'Xóa bài viết'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

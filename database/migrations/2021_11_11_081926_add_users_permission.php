<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddUsersPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'users.view',
                'en' => ['display_name' => 'View Users'],
                'vi' => ['display_name' => 'Xem người dùng'],
            ],
            [
                'name' => 'users.create',
                'en' => ['display_name' => 'Create Users'],
                'vi' => ['display_name' => 'Thêm người dùng'],
            ],
            [
                'name' => 'users.update',
                'en' => ['display_name' => 'Update Users'],
                'vi' => ['display_name' => 'Cập nhật người dùng'],
            ],
            [
                'name' => 'users.delete',
                'en' => ['display_name' => 'Delete Users'],
                'vi' => ['display_name' => 'Xóa người dùng'],
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
                'name' => 'users.view',
                'en' => ['display_name' => 'View Users'],
                'vi' => ['display_name' => 'Xem người dùng'],
            ],
            [
                'name' => 'users.create',
                'en' => ['display_name' => 'Create Users'],
                'vi' => ['display_name' => 'Thêm người dùng'],
            ],
            [
                'name' => 'users.update',
                'en' => ['display_name' => 'Update Users'],
                'vi' => ['display_name' => 'Cập nhật người dùng'],
            ],
            [
                'name' => 'users.delete',
                'en' => ['display_name' => 'Delete Users'],
                'vi' => ['display_name' => 'Xóa người dùng'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}
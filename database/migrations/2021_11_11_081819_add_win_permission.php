<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddWinPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'win.view',
                'en' => ['display_name' => 'View Win'],
                'vi' => ['display_name' => 'Xem người chiến thắng'],
            ],
            [
                'name' => 'win.create',
                'en' => ['display_name' => 'Create Win'],
                'vi' => ['display_name' => 'Thêm người chiến thắng'],
            ],
            [
                'name' => 'win.update',
                'en' => ['display_name' => 'Update Win'],
                'vi' => ['display_name' => 'Cập nhật người chiến thắng'],
            ],
            [
                'name' => 'win.delete',
                'en' => ['display_name' => 'Delete Win'],
                'vi' => ['display_name' => 'Xóa người chiến thắng'],
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
                'name' => 'win.view',
                'en' => ['display_name' => 'View Win'],
                'vi' => ['display_name' => 'Xem người chiến thắng'],
            ],
            [
                'name' => 'win.create',
                'en' => ['display_name' => 'Create Win'],
                'vi' => ['display_name' => 'Thêm người chiến thắng'],
            ],
            [
                'name' => 'win.update',
                'en' => ['display_name' => 'Update Win'],
                'vi' => ['display_name' => 'Cập nhật người chiến thắng'],
            ],
            [
                'name' => 'win.delete',
                'en' => ['display_name' => 'Delete Win'],
                'vi' => ['display_name' => 'Xóa người chiến thắng'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}
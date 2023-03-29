<?php

use App\Domain\Acl\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissionBannersTable extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'banners.view',
                'en' => ['display_name' => 'View Banner'],
                'vi' => ['display_name' => 'Xem banner'],
            ],
            [
                'name' => 'banners.create',
                'en' => ['display_name' => 'Create Banner'],
                'vi' => ['display_name' => 'Thêm banner'],
            ],
            [
                'name' => 'banners.update',
                'en' => ['display_name' => 'Update Banner'],
                'vi' => ['display_name' => 'Cập nhật banner'],
            ],
            [
                'name' => 'banners.delete',
                'en' => ['display_name' => 'Delete Banner'],
                'vi' => ['display_name' => 'Xóa banner'],
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }

    public function down()
    {
        $permissions = [
            [
                'name' => 'banners.view',
                'en' => ['display_name' => 'View Banner'],
                'vi' => ['display_name' => 'Xem banner'],
            ],
            [
                'name' => 'banners.create',
                'en' => ['display_name' => 'Create Banner'],
                'vi' => ['display_name' => 'Thêm banner'],
            ],
            [
                'name' => 'banners.update',
                'en' => ['display_name' => 'Update Banner'],
                'vi' => ['display_name' => 'Cập nhật banner'],
            ],
            [
                'name' => 'banners.delete',
                'en' => ['display_name' => 'Delete Banner'],
                'vi' => ['display_name' => 'Xóa banner'],
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

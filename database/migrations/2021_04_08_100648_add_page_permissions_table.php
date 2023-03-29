<?php

use App\Domain\Acl\Models\Permission;
use Illuminate\Database\Migrations\Migration;

class AddPagePermissionsTable extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'pages.view',
                'en' => ['display_name' => 'View Page'],
                'vi' => ['display_name' => 'Xem trang'],
            ],
            [
                'name' => 'pages.create',
                'en' => ['display_name' => 'Create Page'],
                'vi' => ['display_name' => 'Thêm trang'],
            ],
            [
                'name' => 'pages.update',
                'en' => ['display_name' => 'Update Page'],
                'vi' => ['display_name' => 'Cập nhật trang'],
            ],
            [
                'name' => 'pages.delete',
                'en' => ['display_name' => 'Delete Page'],
                'vi' => ['display_name' => 'Xóa trang'],
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
                'name' => 'pages.view',
                'en' => ['display_name' => 'View Page'],
                'vi' => ['display_name' => 'Xem trang'],
            ],
            [
                'name' => 'pages.create',
                'en' => ['display_name' => 'Create Page'],
                'vi' => ['display_name' => 'Thêm trang'],
            ],
            [
                'name' => 'pages.update',
                'en' => ['display_name' => 'Update Page'],
                'vi' => ['display_name' => 'Cập nhật trang'],
            ],
            [
                'name' => 'pages.delete',
                'en' => ['display_name' => 'Delete Page'],
                'vi' => ['display_name' => 'Xóa trang'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

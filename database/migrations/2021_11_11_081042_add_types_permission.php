<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddTypesPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'types.view',
                'en' => ['display_name' => 'View Type'],
                'vi' => ['display_name' => 'Xem loại truyện'],
            ],
            [
                'name' => 'types.create',
                'en' => ['display_name' => 'Create Type'],
                'vi' => ['display_name' => 'Thêm loại truyện'],
            ],
            [
                'name' => 'types.update',
                'en' => ['display_name' => 'Update Type'],
                'vi' => ['display_name' => 'Cập nhật loại truyện'],
            ],
            [
                'name' => 'types.delete',
                'en' => ['display_name' => 'Delete Type'],
                'vi' => ['display_name' => 'Xóa loại truyện'],
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
                'name' => 'types.view',
                'en' => ['display_name' => 'View Type'],
                'vi' => ['display_name' => 'Xem loại truyện'],
            ],
            [
                'name' => 'types.create',
                'en' => ['display_name' => 'Create Type'],
                'vi' => ['display_name' => 'Thêm loại truyện'],
            ],
            [
                'name' => 'types.update',
                'en' => ['display_name' => 'Update Type'],
                'vi' => ['display_name' => 'Cập nhật loại truyện'],
            ],
            [
                'name' => 'types.delete',
                'en' => ['display_name' => 'Delete Type'],
                'vi' => ['display_name' => 'Xóa loại truyện'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;
class AddCategoriesPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'categories.view',
                'en' => ['display_name' => 'View Category'],
                'vi' => ['display_name' => 'Xem thể loại'],
            ],
            [
                'name' => 'categories.create',
                'en' => ['display_name' => 'Create Category'],
                'vi' => ['display_name' => 'Thêm thể loại'],
            ],
            [
                'name' => 'categories.update',
                'en' => ['display_name' => 'Update Category'],
                'vi' => ['display_name' => 'Cập nhật thể loại'],
            ],
            [
                'name' => 'categories.delete',
                'en' => ['display_name' => 'Delete Category'],
                'vi' => ['display_name' => 'Xóa thể loại'],
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
                'name' => 'categories.view',
                'en' => ['display_name' => 'View Category'],
                'vi' => ['display_name' => 'Xem thể loại'],
            ],
            [
                'name' => 'categories.create',
                'en' => ['display_name' => 'Create Category'],
                'vi' => ['display_name' => 'Thêm thể loại'],
            ],
            [
                'name' => 'categories.update',
                'en' => ['display_name' => 'Update Category'],
                'vi' => ['display_name' => 'Cập nhật thể loại'],
            ],
            [
                'name' => 'categories.delete',
                'en' => ['display_name' => 'Delete Category'],
                'vi' => ['display_name' => 'Xóa thể loại'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

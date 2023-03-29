<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddStoriesPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'stories.view',
                'en' => ['display_name' => 'View Story'],
                'vi' => ['display_name' => 'Xem truyện'],
            ],
            [
                'name' => 'stories.create',
                'en' => ['display_name' => 'Create Story'],
                'vi' => ['display_name' => 'Thêm truyện'],
            ],
            [
                'name' => 'stories.update',
                'en' => ['display_name' => 'Update Story'],
                'vi' => ['display_name' => 'Cập nhật truyện'],
            ],
            [
                'name' => 'stories.delete',
                'en' => ['display_name' => 'Delete Story'],
                'vi' => ['display_name' => 'Xóa truyện'],
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
                'name' => 'stories.view',
                'en' => ['display_name' => 'View Story'],
                'vi' => ['display_name' => 'Xem truyện'],
            ],
            [
                'name' => 'stories.create',
                'en' => ['display_name' => 'Create Story'],
                'vi' => ['display_name' => 'Thêm truyện'],
            ],
            [
                'name' => 'stories.update',
                'en' => ['display_name' => 'Update Story'],
                'vi' => ['display_name' => 'Cập nhật truyện'],
            ],
            [
                'name' => 'stories.delete',
                'en' => ['display_name' => 'Delete Story'],
                'vi' => ['display_name' => 'Xóa truyện'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

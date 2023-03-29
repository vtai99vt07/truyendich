<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddGamePermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'game.view',
                'en' => ['display_name' => 'View Game'],
                'vi' => ['display_name' => 'Xem trò chơi'],
            ],
            [
                'name' => 'game.create',
                'en' => ['display_name' => 'Create Game'],
                'vi' => ['display_name' => 'Thêm trò chơi'],
            ],
            [
                'name' => 'game.update',
                'en' => ['display_name' => 'Update Game'],
                'vi' => ['display_name' => 'Cập nhật trò chơi'],
            ],
            [
                'name' => 'game.delete',
                'en' => ['display_name' => 'Delete Game'],
                'vi' => ['display_name' => 'Xóa trò chơi'],
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
                'name' => 'game.view',
                'en' => ['display_name' => 'View Game'],
                'vi' => ['display_name' => 'Xem trò chơi'],
            ],
            [
                'name' => 'game.create',
                'en' => ['display_name' => 'Create Game'],
                'vi' => ['display_name' => 'Thêm trò chơi'],
            ],
            [
                'name' => 'game.update',
                'en' => ['display_name' => 'Update Game'],
                'vi' => ['display_name' => 'Cập nhật trò chơi'],
            ],
            [
                'name' => 'game.delete',
                'en' => ['display_name' => 'Delete Game'],
                'vi' => ['display_name' => 'Xóa trò chơi'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddPermissions extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'log-activities.index',
                'en' => ['display_name' => 'View Log Activities'],
                'vi' => ['display_name' => 'Xem lịch sử thao tác'],
            ],
            [
                'name' => 'log-activities.destroy',
                'en' => ['display_name' => 'Delete Log Activities'],
                'vi' => ['display_name' => 'Xóa lịch sử thao tác'],
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
                'name' => 'log-activities.index',
                'en' => ['display_name' => 'View Log Activities'],
                'vi' => ['display_name' => 'Xem lịch sử thao tác'],
            ],
            [
                'name' => 'log-activities.destroy',
                'en' => ['display_name' => 'Delete Log Activities'],
                'vi' => ['display_name' => 'Xóa lịch sử thao tác'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

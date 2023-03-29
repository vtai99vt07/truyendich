<?php

use App\Domain\Acl\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissionClients extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'log-search.view',
                'en' => ['display_name' => 'View Log Search'],
                'vi' => ['display_name' => 'Xem lịch sử tìm kiếm'],
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
                'name' => 'log-search.view',
                'en' => ['display_name' => 'View Log Search'],
                'vi' => ['display_name' => 'Xem lịch sử tìm kiếm'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}

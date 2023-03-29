<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddWalletsPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'wallets.view',
                'en' => ['display_name' => 'View Wallet'],
                'vi' => ['display_name' => 'Xem ví'],
            ],
            [
                'name' => 'wallets.create',
                'en' => ['display_name' => 'Create Wallet'],
                'vi' => ['display_name' => 'Thêm ví'],
            ],
            [
                'name' => 'wallets.update',
                'en' => ['display_name' => 'Update Wallet'],
                'vi' => ['display_name' => 'Cập nhật ví'],
            ],
            [
                'name' => 'wallets.delete',
                'en' => ['display_name' => 'Delete Wallet'],
                'vi' => ['display_name' => 'Xóa ví'],
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
                'name' => 'wallets.view',
                'en' => ['display_name' => 'View Wallet'],
                'vi' => ['display_name' => 'Xem ví'],
            ],
            [
                'name' => 'wallets.create',
                'en' => ['display_name' => 'Create Wallet'],
                'vi' => ['display_name' => 'Thêm ví'],
            ],
            [
                'name' => 'wallets.update',
                'en' => ['display_name' => 'Update Wallet'],
                'vi' => ['display_name' => 'Cập nhật ví'],
            ],
            [
                'name' => 'wallets.delete',
                'en' => ['display_name' => 'Delete Wallet'],
                'vi' => ['display_name' => 'Xóa ví'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}
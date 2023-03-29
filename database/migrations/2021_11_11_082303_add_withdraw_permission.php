<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddWithdrawPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'withdraw.view',
                'en' => ['display_name' => 'View Withdraw'],
                'vi' => ['display_name' => 'Xem ví'],
            ],
            [
                'name' => 'withdraw.create',
                'en' => ['display_name' => 'Create Withdraw'],
                'vi' => ['display_name' => 'Thêm ví'],
            ],
            [
                'name' => 'withdraw.update',
                'en' => ['display_name' => 'Update Withdraw'],
                'vi' => ['display_name' => 'Cập nhật ví'],
            ],
            [
                'name' => 'withdraw.delete',
                'en' => ['display_name' => 'Delete Withdraw'],
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
                'name' => 'withdraw.view',
                'en' => ['display_name' => 'View Withdraw'],
                'vi' => ['display_name' => 'Xem ví'],
            ],
            [
                'name' => 'withdraw.create',
                'en' => ['display_name' => 'Create Withdraw'],
                'vi' => ['display_name' => 'Thêm ví'],
            ],
            [
                'name' => 'withdraw.update',
                'en' => ['display_name' => 'Update Withdraw'],
                'vi' => ['display_name' => 'Cập nhật ví'],
            ],
            [
                'name' => 'withdraw.delete',
                'en' => ['display_name' => 'Delete Withdraw'],
                'vi' => ['display_name' => 'Xóa rút tiền'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}
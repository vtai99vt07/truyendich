<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddRechargeTransactionsPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'recharge_transactions.view',
                'en' => ['display_name' => 'View Recharge Transaction'],
                'vi' => ['display_name' => 'Xem nạp tiền'],
            ],
            [
                'name' => 'recharge_transactions.create',
                'en' => ['display_name' => 'Create Recharge Transaction'],
                'vi' => ['display_name' => 'Thêm nạp tiền'],
            ],
            [
                'name' => 'recharge_transactions.update',
                'en' => ['display_name' => 'Update Recharge Transaction'],
                'vi' => ['display_name' => 'Cập nhật nạp tiền'],
            ],
            [
                'name' => 'recharge_transactions.delete',
                'en' => ['display_name' => 'Delete Recharge Transaction'],
                'vi' => ['display_name' => 'Xóa nạp tiền'],
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
                'name' => 'recharge_transactions.view',
                'en' => ['display_name' => 'View Recharge Transaction'],
                'vi' => ['display_name' => 'Xem nạp tiền'],
            ],
            [
                'name' => 'recharge_transactions.create',
                'en' => ['display_name' => 'Create Recharge Transaction'],
                'vi' => ['display_name' => 'Thêm nạp tiền'],
            ],
            [
                'name' => 'recharge_transactions.update',
                'en' => ['display_name' => 'Update Recharge Transaction'],
                'vi' => ['display_name' => 'Cập nhật nạp tiền'],
            ],
            [
                'name' => 'recharge_transactions.delete',
                'en' => ['display_name' => 'Delete Recharge Transaction'],
                'vi' => ['display_name' => 'Xóa nạp tiền'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}
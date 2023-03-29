<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddWalletTransactionPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'wallet-transaction.view',
                'en' => ['display_name' => 'View Wallet Transaction'],
                'vi' => ['display_name' => 'Xem giao dịch ví'],
            ],
            [
                'name' => 'wallet-transaction.create',
                'en' => ['display_name' => 'Create Wallet Transaction'],
                'vi' => ['display_name' => 'Thêm giao dịch ví'],
            ],
            [
                'name' => 'wallet-transaction.update',
                'en' => ['display_name' => 'Update Wallet Transaction'],
                'vi' => ['display_name' => 'Cập nhật giao dịch ví'],
            ],
            [
                'name' => 'wallet-transaction.delete',
                'en' => ['display_name' => 'Delete Wallet Transaction'],
                'vi' => ['display_name' => 'Xóa giao dịch ví'],
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
                'name' => 'wallet-transaction.view',
                'en' => ['display_name' => 'View Wallet Transaction'],
                'vi' => ['display_name' => 'Xem giao dịch ví'],
            ],
            [
                'name' => 'wallet-transaction.create',
                'en' => ['display_name' => 'Create Wallet Transaction'],
                'vi' => ['display_name' => 'Thêm giao dịch ví'],
            ],
            [
                'name' => 'wallet-transaction.update',
                'en' => ['display_name' => 'Update Wallet Transaction'],
                'vi' => ['display_name' => 'Cập nhật giao dịch ví'],
            ],
            [
                'name' => 'wallet-transaction.delete',
                'en' => ['display_name' => 'Delete Wallet Transaction'],
                'vi' => ['display_name' => 'Xóa giao dịch ví'],
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}
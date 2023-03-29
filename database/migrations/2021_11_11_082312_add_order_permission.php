<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Acl\Models\Permission;

class AddOrderPermission extends Migration
{
    public function up()
    {
        $permissions = [
            [
                'name' => 'order.view',
                'en' => ['display_name' => 'View Order'],
                'vi' => ['display_name' => 'Xem đơn mua chương VIP'],
            ],
            [
                'name' => 'order.create',
                'en' => ['display_name' => 'Create Order'],
                'vi' => ['display_name' => 'Thêm đơn mua chương VIP'],
            ],
            [
                'name' => 'order.update',
                'en' => ['display_name' => 'Update Order'],
                'vi' => ['display_name' => 'Cập nhật đơn mua chương VIP'],
            ],
            [
                'name' => 'order.delete',
                'en' => ['display_name' => 'Delete Order'],
                'vi' => ['display_name' => 'Xóa đơn mua chương VIP'],
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
                'name' => 'order.view',
                'en' => ['display_name' => 'View Order'],
                'vi' => ['display_name' => 'Xem đơn mua chương VIP'],
            ],
            [
                'name' => 'order.create',
                'en' => ['display_name' => 'Create Order'],
                'vi' => ['display_name' => 'Thêm đơn mua chương VIP'],
            ],
            [
                'name' => 'order.update',
                'en' => ['display_name' => 'Update Order'],
                'vi' => ['display_name' => 'Cập nhật đơn mua chương VIP'],
            ],
            [
                'name' => 'order.delete',
                'en' => ['display_name' => 'Delete Order'],
                'vi' => ['display_name' => 'Xóa đơn mua chương VIP'],
            ]
        ]; 

        foreach ($permissions as $permission) {
            Permission::where('name', $permission['name'])->delete();
        }
    }
}
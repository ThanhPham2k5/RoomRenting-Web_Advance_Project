<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Permissions
        $permissions = [
            //Post
            'create post',
            'update post',
            'delete post',
            'view post',
            'view all post',

            //Comment
            'create comment',
            'update comment',
            'delete comment',
            'view comment',

            //Bill
            'create payBill',
            'create payRule',
            'update payBill',
            'update payRule',
            'delete payBill',
            'delete payRule',
            'view payBill',
            'view payRule',

            //Recharge
            'create rechargeBill',
            'create rechargeRule',
            'update rechargeBill',
            'update rechargeRule',
            'delete rechargeBill',
            'delete rechargeRule',
            'view rechargeBill',
            'view rechargeRule',

            //Form
            'update form',
            'view form',
            'view all form',

            //Account
            'create account',
            'update account',
            'delete account',
            'view account',
            'view all account',

            //User
            'create user',
            'update user',
            'delete user',
            'view user',
            'view all user',

            //Employee
            'create employee',
            'update employee',
            'delete employee',
            'view employee',
            'view all employee',

            //PersonalInfo
            'create personalInfo',
            'update personalInfo',
            'delete personalInfo',
            'view personalInfo',
            'view all personalInfo',
        ];

        foreach($permissions as $permission)
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        

        //Roles
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $postManager = Role::create(['name' => 'postManager', 'guard_name' => 'api']);
        $billManager = Role::create(['name' => 'billManager', 'guard_name' => 'api']);
        $userManager = Role::create(['name' => 'userManager', 'guard_name' => 'api']);
        $user = Role::create(['name' => 'user', 'guard_name' => 'api']);

        
        //Assign Roles
        $admin->givePermissionTo(Permission::all());
        $postManager->givePermissionTo([
            'create post',
            'update post',
            'delete post',
            'view post'
        ]);
        $billManager->givePermissionTo([
            //Bill
            'create payRule',
            'update payBill',
            'update payRule',
            'delete payBill',
            'delete payRule',
            'view payBill',
            'view payRule',

            //Recharge
            'create rechargeRule',
            'update rechargeBill',
            'update rechargeRule',
            'delete rechargeBill',
            'delete rechargeRule',
            'view rechargeBill',
            'view rechargeRule',
        ]);
        $userManager->givePermissionTo([
            //Account
            'create account',
            'update account',
            'delete account',
            'view account',
            'view all account',

            //User
            'create user',
            'update user',
            'delete user',
            'view user',
            'view all user',

            //Employee
            'create employee',
            'update employee',
            'delete employee',
            'view employee',
            'view all employee',

            //PersonalInfo
            'create personalInfo',
            'update personalInfo',
            'delete personalInfo',
            'view personalInfo',
            'view all personalInfo',
        ]);
        $user->givePermissionTo([
            'create account',
            'create user',
            'create rechargeBill',
            'create post',
            'create payBill',
            'create comment',
            'create personalInfo',
            'update personalInfo',
            'update form',
            'update comment',
            'delete comment',
            'view account',
            'view user',
            'view personalInfo',
            'view comment',
            'view post',
            'view all post',
            'view payBill',
            'view rechargeBill',
            'view form',
        ]);
    }
}

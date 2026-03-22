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
            'post.create',
            'post.update',
            'post.delete',
            'post.get',
            'post.getAll',

            //PostImages
            'postImage.create',
            'postImage.update',
            'postImage.delete',
            'postImage.get',
            'postImage.getAll',

            //Comment
            'comment.create',
            'comment.update',
            'comment.delete',
            'comment.get',
            'comment.getAll',

            //Favorite
            'favorite.create',
            'favorite.delete',
            'favorite.get',
            'favorite.getAll',

            //Bill
            'payBill.create',
            'payRule.create',
            'payBill.update',
            'payRule.update',
            'payBill.delete',
            'payRule.delete',
            'payBill.get',
            'payBill.getAll',
            'payRule.get',
            'payRule.getAll',

            //Recharge
            'rechargeBill.create',
            'rechargeRule.create',
            'rechargeBill.update',
            'rechargeRule.update',
            'rechargeBill.delete',
            'rechargeRule.delete',
            'rechargeBill.get',
            'rechargeBill.getAll',
            'rechargeRule.get',
            'rechargeRule.getAll',

            //Form
            'form.create',
            'form.update',
            'form.get',
            'form.getAll',
            'form.getRecommendation',

            //Notification
            'notification.create',
            'notification.update',
            'notification.get',
            'notification.delete',
            'notification.getAll',

            //Account
            'account.create',
            'account.update',
            'account.delete',
            'account.get',
            'account.getAll',

            //User
            'user.create',
            'user.update',
            'user.delete',
            'user.get',
            'user.getAll',

            //Employee
            'employee.create',
            'employee.update',
            'employee.delete',
            'employee.get',
            'employee.getAll',

            //PersonalInfo
            'personalInfo.create',
            'personalInfo.update',
            'personalInfo.delete',
            'personalInfo.get',
            'personalInfo.getAll',

            //Assign
            'account.assignRoles',
            'account.assignPermissions',
            'account.syncRoles'
        ];


        foreach($permissions as $permission)
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        
        //Roles
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $postManager = Role::create(['name' => 'postManager', 'guard_name' => 'api']);
        $billManager = Role::create(['name' => 'billManager', 'guard_name' => 'api']);
        $userManager = Role::create(['name' => 'userManager', 'guard_name' => 'api']);
        $commentManager = Role::create(['name' => 'commentManager', 'guard_name' => 'api']);
        $user = Role::create(['name' => 'user', 'guard_name' => 'api']);

        
        //Assign Roles
        $admin->givePermissionTo(Permission::all());
        $postManager->givePermissionTo([
            //Post
            'post.create',
            'post.update',
            'post.delete',
            'post.get',
            'post.getAll',

            //PostImage
            'postImage.create',
            'postImage.update',
            'postImage.delete',
            'postImage.get',
            'postImage.getAll',
        ]);
        $commentManager->givePermissionTo([
            //Comment
            'comment.create',
            'comment.update',
            'comment.delete',
            'comment.get',
            'comment.getAll',
        ]);
        $billManager->givePermissionTo([
            //Bill
            'payRule.create',
            'payBill.update',
            'payRule.update',
            'payBill.delete',
            'payRule.delete',
            'payBill.get',
            'payBill.getAll',
            'payRule.get',
            'payRule.getAll',

            //Recharge
            'rechargeRule.create',
            'rechargeBill.update',
            'rechargeRule.update',
            'rechargeBill.delete',
            'rechargeRule.delete',
            'rechargeBill.get',
            'rechargeBill.getAll',
            'rechargeRule.get',
            'rechargeRule.getAll',
        ]);
        $userManager->givePermissionTo([
            //Account
            'account.create',
            'account.update',
            'account.delete',
            'account.get',
            'account.getAll',

            //User
            'user.create',
            'user.update',
            'user.delete',
            'user.get',
            'user.getAll',

            //Employee
            'employee.create',
            'employee.update',
            'employee.delete',
            'employee.get',
            'employee.getAll',

            //PersonalInfo
            'personalInfo.create',
            'personalInfo.update',
            'personalInfo.delete',
            'personalInfo.get',
            'personalInfo.getAll',

            //Assign
            'account.assignRoles',
            'account.assignPermissions',
            'account.syncRoles'
        ]);
        $user->givePermissionTo([
            //Account
            'account.create',
            'account.update',
            'account.get',
        
            //User
            'user.update',
            'user.get',

            //PersonalInfo
            'personalInfo.create',
            'personalInfo.update',
            'personalInfo.get',

            //RechargeBill
            'rechargeBill.create',
            'rechargeBill.get',

            //PayBill
            'payBill.create',
            'payBill.get',

            //Post
            'post.create',
            'post.update',
            'post.delete',
            'post.get',
            'post.getAll',

            //PostImage
            'postImage.create',
            'postImage.update',
            'postImage.delete',
            'postImage.get',
            'postImage.getAll',

            //Comment
            'comment.create',
            'comment.update',
            'comment.get',
            'comment.getAll',
            'comment.delete',

            //Favorite
            'favorite.create',
            'favorite.delete',
            'favorite.get',
            'favorite.getAll',

            //Form
            'form.create',
            'form.update',
            'form.get',
            'form.getRecommendation',

            //Notification
            'notification.create',
            'notification.update',
            'notification.get',
            'notification.delete',
            'notification.getAll',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Account_User\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Account::create([ //create a useable admin
        //     'username' => 'admin',
        //     'password' => Hash::make('admin123'),
        //     'role' => 'admin'
        // ]);


        $accounts = [
            [
                'username' => 'admin',
                'password' => bcrypt('Admin@123456'),
                'role' => 'admin'
            ],
            [
                'username' => 'post_manager',
                'password' => bcrypt('Post@123456'),
                'role' => 'postManager'
            ],
            [
                'username' => 'bill_manager',
                'password' => bcrypt('Bill@123456'),
                'role' => 'billManager'
            ],
            [
                'username' => 'user_manager',
                'password' => bcrypt('UserMng@123456'),
                'role' => 'userManager'
            ],
            [
                'username' => 'an.nguyen',
                'password' => bcrypt('An@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'binh.tran',
                'password' => bcrypt('Binh@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'hoang.le',
                'password' => bcrypt('Hoang@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'lan.pham',
                'password' => bcrypt('Lan@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'huy.le',
                'password' => bcrypt('Huy@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'lananh.le',
                'password' => bcrypt('LanAnh@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'bao.nguyen',
                'password' => bcrypt('Bao@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'linh.dang',
                'password' => bcrypt('Linh@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'tung.phan',
                'password' => bcrypt('Tung@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'mai.bui',
                'password' => bcrypt('Mai@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'tuan.vo',
                'password' => bcrypt('Tuan@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'ha.nguyen',
                'password' => bcrypt('Ha@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'hung.truong',
                'password' => bcrypt('Hung@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'chi.hoang',
                'password' => bcrypt('Chi@123456'),
                'role' => 'user'
            ],
        ];

        foreach ($accounts as $data) {
            $account = Account::create([
                'username' => $data['username'],
                'password' => $data['password'],
            ]);

            // assign Spatie role
            $account->assignRole($data['role']);
        }
    }
}

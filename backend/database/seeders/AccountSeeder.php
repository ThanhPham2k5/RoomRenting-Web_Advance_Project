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
                'password' => bcrypt('Admin@123'),
                'role' => 'admin'
            ],
            [
                'username' => 'post_manager',
                'password' => bcrypt('Post@123'),
                'role' => 'postManager'
            ],
            [
                'username' => 'bill_manager',
                'password' => bcrypt('Bill@123'),
                'role' => 'billManager'
            ],
            [
                'username' => 'user_manager',
                'password' => bcrypt('UserMng@123'),
                'role' => 'userManager'
            ],
            [
                'username' => 'an.nguyen',
                'password' => bcrypt('An@123'),
                'role' => 'user'
            ],
            [
                'username' => 'binh.tran',
                'password' => bcrypt('Binh@123'),
                'role' => 'user'
            ],
            [
                'username' => 'hoang.le',
                'password' => bcrypt('Hoang@123'),
                'role' => 'user'
            ],
            [
                'username' => 'lan.pham',
                'password' => bcrypt('Lan@123'),
                'role' => 'user'
            ],
            [
                'username' => 'huy.le',
                'password' => bcrypt('Huy@123'),
                'role' => 'user'
            ],
            [
                'username' => 'lananh.le',
                'password' => bcrypt('LanAnh@123'),
                'role' => 'user'
            ],
            [
                'username' => 'bao.nguyen',
                'password' => bcrypt('Bao@123'),
                'role' => 'user'
            ],
            [
                'username' => 'linh.dang',
                'password' => bcrypt('Linh@123'),
                'role' => 'user'
            ],
            [
                'username' => 'tung.phan',
                'password' => bcrypt('Tung@123'),
                'role' => 'user'
            ],
            [
                'username' => 'mai.bui',
                'password' => bcrypt('Mai@123'),
                'role' => 'user'
            ],
            [
                'username' => 'tuan.vo',
                'password' => bcrypt('Tuan@123'),
                'role' => 'user'
            ],
            [
                'username' => 'ha.nguyen',
                'password' => bcrypt('Ha@123'),
                'role' => 'user'
            ],
            [
                'username' => 'hung.truong',
                'password' => bcrypt('Hung@123'),
                'role' => 'user'
            ],
            [
                'username' => 'chi.hoang',
                'password' => bcrypt('Chi@123'),
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

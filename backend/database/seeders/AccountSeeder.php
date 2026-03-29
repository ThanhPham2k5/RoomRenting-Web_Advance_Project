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
                'username' => 'comment_manager',
                'password' => bcrypt('Comment@123456'),
                'role' => 'commentManager'
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
                'username' => 'annguyen',
                'password' => bcrypt('An@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'binhtran',
                'password' => bcrypt('Binh@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'hoangle',
                'password' => bcrypt('Hoang@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'lanpham',
                'password' => bcrypt('Lan@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'huyle',
                'password' => bcrypt('Huy@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'lananhle',
                'password' => bcrypt('LanAnh@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'baonguyen',
                'password' => bcrypt('Bao@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'linhdang',
                'password' => bcrypt('Linh@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'tungphan',
                'password' => bcrypt('Tung@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'maibui',
                'password' => bcrypt('Mai@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'tuanvo',
                'password' => bcrypt('Tuan@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'hanguyen',
                'password' => bcrypt('Ha@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'hungtruong',
                'password' => bcrypt('Hung@123456'),
                'role' => 'user'
            ],
            [
                'username' => 'chihoang',
                'password' => bcrypt('Chi@123456'),
                'role' => 'user'
            ],
        ];

        foreach ($accounts as $data) {
            $account = Account::create([
                'role' => $data['role'] == 'user' ? 'user' : 'employee',
                'username' => $data['username'],
                'password' => $data['password'],
            ]);

            // assign Spatie role
            $account->assignRole($data['role']);
        }
    }
}

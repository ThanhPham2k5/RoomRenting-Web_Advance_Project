<?php

namespace Database\Seeders;

use App\Helpers\VietnamAddress;
use App\Models\Account_User\Account;
use App\Models\Account_User\PersonalInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $people = [
            [
                'name' => 'Nguyễn Văn An',
                'gender' => 'Nam',
                'dob' => '2000-05-10',
                'email' => 'annguyen@example.com',
            ],
            [
                'name' => 'Nguyễn Thanh Bình',
                'gender' => 'Nam',
                'dob' => '1997-02-08',
                'email' => 'thanhbinh@example.com',
            ],
            [
                'name' => 'Trần Thị Bình',
                'gender' => 'Nữ',
                'dob' => '1999-08-21',
                'email' => 'binhtran@example.com',
            ],
            [
                'name' => 'Lê Minh Hoàng',
                'gender' => 'Nam',
                'dob' => '2001-01-15',
                'email' => 'hoangle@example.com',
            ],
            [
                'name' => 'Phạm Thị Lan',
                'gender' => 'Nữ',
                'dob' => '2002-11-30',
                'email' => 'lanpham@example.com',
            ],
            [
                'name' => 'Lê Nhật Huy',
                'gender' => 'Nam',
                'dob' => '2004-01-15',
                'email' => 'huyle@example.com',
            ],
            [
                'name' => 'Lê Thị Lan Anh',
                'gender' => 'Nữ',
                'dob' => '1995-11-30',
                'email' => 'lananhle@example.com',
            ],
            [
                'name' => 'Nguyễn Quốc Bảo',
                'gender' => 'Nam',
                'dob' => '1998-03-12',
                'email' => 'baonguyen@example.com',
            ],
            [
                'name' => 'Đặng Thị Mỹ Linh',
                'gender' => 'Nữ',
                'dob' => '2000-09-05',
                'email' => 'linhdang@example.com',
            ],
            [
                'name' => 'Phan Thanh Tùng',
                'gender' => 'Nam',
                'dob' => '1997-07-19',
                'email' => 'tungphan@example.com',
            ],
            [
                'name' => 'Bùi Thị Ngọc Mai',
                'gender' => 'Nữ',
                'dob' => '2003-02-25',
                'email' => 'maibui@example.com',
            ],
            [
                'name' => 'Võ Minh Tuấn',
                'gender' => 'Nam',
                'dob' => '1996-12-01',
                'email' => 'tuanvo@example.com',
            ],
            [
                'name' => 'Nguyễn Thị Thu Hà',
                'gender' => 'Nữ',
                'dob' => '1994-06-14',
                'email' => 'hanguyen@example.com',
            ],
            [
                'name' => 'Trương Gia Hưng',
                'gender' => 'Nam',
                'dob' => '2001-10-08',
                'email' => 'hungtruong@example.com',
            ],
            [
                'name' => 'Hoàng Thị Kim Chi',
                'gender' => 'Nữ',
                'dob' => '1999-04-17',
                'email' => 'chihoang@example.com',
            ],
            [
                'name' => 'Ngô Quang Vinh',
                'gender' => 'Nam',
                'dob' => '2002-08-29',
                'email' => 'vinhngo@example.com',
            ],
            [
                'name' => 'Phạm Ngọc Ánh',
                'gender' => 'Nữ',
                'dob' => '2000-01-03',
                'email' => 'anhpham@example.com',
            ],
            [
                'name' => 'Lý Hoàng Nam',
                'gender' => 'Nam',
                'dob' => '1998-11-22',
                'email' => 'namly@example.com',
            ],
            [
                'name' => 'Đỗ Thị Thanh Hương',
                'gender' => 'Nữ',
                'dob' => '1997-05-27',
                'email' => 'huongdo@example.com',
            ],
        ];


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

        foreach ($accounts as $index => $data) {
            $account = Account::create([
                'role' => $data['role'] == 'user' ? 'user' : 'employee',
                'username' => $data['username'],
                'password' => $data['password'],
            ]);

            // assign Spatie role
            $account->assignRole($data['role']);

            //create personalInfo

            $person = $people[$index]; // Lấy dữ liệu người tương ứng theo index
            
            $province = VietnamAddress::randomProvince();
            $ward = VietnamAddress::randomWard($province['province_code']);

            PersonalInfo::create([
                'id'           => $account->id,
                'name'         => $person['name'],
                'gender'       => $person['gender'],
                'date_of_birth'=> $person['dob'],
                'email'        => $person['email'],
                'house_number' => $this->houseNumber(),
                'ward'         => $ward['name'],
                'province'     => $province['name'],
                'phone_number' => $this->phone(),
                'pid'          => $this->pid(),
            ]);
        }
    }

    private function houseNumber()
    {
        return collect([
            '12/5', '45A', '102B', '7/12/3', '88'
        ])->random();
    }

    private function phone()
    {
        return '0' . rand(300000000, 999999999);
    }

    private function pid()
    {
        return '0' . rand(100000000000, 999999999999);
    }
}

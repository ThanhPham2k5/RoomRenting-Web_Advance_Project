<?php

namespace Database\Seeders;

use App\Helpers\VietnamAddress;
use App\Models\Account_User\PersonalInfo;
use Illuminate\Database\Seeder;

class PersonalInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PersonalInfo::factory()->count(50)->create(); //might be unecessary

        $people = [
            [
                'name' => 'Nguyễn Văn An',
                'gender' => 'male',
                'dob' => '2000-05-10',
                'profile_url' => '',
            ],
            [
                'name' => 'Trần Thị Bình',
                'gender' => 'female',
                'dob' => '1999-08-21',
                'profile_url' => '',
            ],
            [
                'name' => 'Lê Minh Hoàng',
                'gender' => 'male',
                'dob' => '2001-01-15',
                'profile_url' => '',
            ],
            [
                'name' => 'Phạm Thị Lan',
                'gender' => 'female',
                'dob' => '2002-11-30',
                'profile_url' => '',
            ],
            [
                'name' => 'Lê Nhật Huy',
                'gender' => 'male',
                'dob' => '2004-01-15',
                'profile_url' => '',
            ],
            [
                'name' => 'Lê Thị Lan Anh',
                'gender' => 'female',
                'dob' => '1995-11-30',
                'profile_url' => '',
            ],
            [
                'name' => 'Nguyễn Quốc Bảo',
                'gender' => 'male',
                'dob' => '1998-03-12',
                'profile_url' => '',
            ],
            [
                'name' => 'Đặng Thị Mỹ Linh',
                'gender' => 'female',
                'dob' => '2000-09-05',
                'profile_url' => '',
            ],
            [
                'name' => 'Phan Thanh Tùng',
                'gender' => 'male',
                'dob' => '1997-07-19',
                'profile_url' => '',
            ],
            [
                'name' => 'Bùi Thị Ngọc Mai',
                'gender' => 'female',
                'dob' => '2003-02-25',
                'profile_url' => '',
            ],
            [
                'name' => 'Võ Minh Tuấn',
                'gender' => 'male',
                'dob' => '1996-12-01',
                'profile_url' => '',
            ],
            [
                'name' => 'Nguyễn Thị Thu Hà',
                'gender' => 'female',
                'dob' => '1994-06-14',
                'profile_url' => '',
            ],
            [
                'name' => 'Trương Gia Hưng',
                'gender' => 'male',
                'dob' => '2001-10-08',
                'profile_url' => '',
            ],
            [
                'name' => 'Hoàng Thị Kim Chi',
                'gender' => 'female',
                'dob' => '1999-04-17',
                'profile_url' => '',
            ],
            [
                'name' => 'Ngô Quang Vinh',
                'gender' => 'male',
                'dob' => '2002-08-29',
                'profile_url' => '',
            ],
            [
                'name' => 'Phạm Ngọc Ánh',
                'gender' => 'female',
                'dob' => '2000-01-03',
                'profile_url' => '',
            ],
            [
                'name' => 'Lý Hoàng Nam',
                'gender' => 'male',
                'dob' => '1998-11-22',
                'profile_url' => '',
            ],
            [
                'name' => 'Đỗ Thị Thanh Hương',
                'gender' => 'female',
                'dob' => '1997-05-27',
                'profile_url' => '',
            ],
            [
                'name' => 'Nguyễn Trung Kiên',
                'gender' => 'male',
                'dob' => '2003-09-11',
                'profile_url' => '',
            ],
            [
                'name' => 'Trần Ngọc Bích',
                'gender' => 'female',
                'dob' => '2001-12-19',
                'profile_url' => '',
            ],
        ];

        foreach ($people as $person) {
            $province = VietnamAddress::randomProvince();
            $ward = VietnamAddress::randomWard($province['province_code']);

            PersonalInfo::create([
                'name' => $person['name'],
                'gender' => $person['gender'],
                'date_of_birth' => $person['dob'],

                'house_number' => $this->houseNumber(),
                'ward' => $ward['name'],
                'province' => $province['name'],

                'phone_number' => $this->phone(),
                'profile_url' => $person['profile_url'],
                'pid' => $this->pid(),
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

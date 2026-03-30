<?php

namespace Database\Seeders;

use App\Helpers\VietnamAddress;
use App\Models\Account_User\PersonalInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PersonalInfoSeeder extends Seeder //UNUSED
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
                'email' => 'annguyen@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=annguyen',
            ],
            [
                'name' => 'Nguyễn Thanh Bình',
                'gender' => 'male',
                'dob' => '1997-02-08',
                'email' => 'thanhbinh@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=thanhbinh',
            ],
            [
                'name' => 'Trần Thị Bình',
                'gender' => 'female',
                'dob' => '1999-08-21',
                'email' => 'binhtran@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=binhtran',
            ],
            [
                'name' => 'Lê Minh Hoàng',
                'gender' => 'male',
                'dob' => '2001-01-15',
                'email' => 'hoangle@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=hoangle',
            ],
            [
                'name' => 'Phạm Thị Lan',
                'gender' => 'female',
                'dob' => '2002-11-30',
                'email' => 'lanpham@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=lanpham',
            ],
            [
                'name' => 'Lê Nhật Huy',
                'gender' => 'male',
                'dob' => '2004-01-15',
                'email' => 'huyle@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=huyle',
            ],
            [
                'name' => 'Lê Thị Lan Anh',
                'gender' => 'female',
                'dob' => '1995-11-30',
                'email' => 'lananhle@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=lananhle',
            ],
            [
                'name' => 'Nguyễn Quốc Bảo',
                'gender' => 'male',
                'dob' => '1998-03-12',
                'email' => 'baonguyen@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=baonguyen',
            ],
            [
                'name' => 'Đặng Thị Mỹ Linh',
                'gender' => 'female',
                'dob' => '2000-09-05',
                'email' => 'linhdang@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=linhdang',
            ],
            [
                'name' => 'Phan Thanh Tùng',
                'gender' => 'male',
                'dob' => '1997-07-19',
                'email' => 'tungphan@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=tungphan',
            ],
            [
                'name' => 'Bùi Thị Ngọc Mai',
                'gender' => 'female',
                'dob' => '2003-02-25',
                'email' => 'maibui@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=maibui',
            ],
            [
                'name' => 'Võ Minh Tuấn',
                'gender' => 'male',
                'dob' => '1996-12-01',
                'email' => 'tuanvo@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=tuanvo',
            ],
            [
                'name' => 'Nguyễn Thị Thu Hà',
                'gender' => 'female',
                'dob' => '1994-06-14',
                'email' => 'hanguyen@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=hanguyen',
            ],
            [
                'name' => 'Trương Gia Hưng',
                'gender' => 'male',
                'dob' => '2001-10-08',
                'email' => 'hungtruong@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=hungtruong',
            ],
            [
                'name' => 'Hoàng Thị Kim Chi',
                'gender' => 'female',
                'dob' => '1999-04-17',
                'email' => 'chihoang@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=chihoang',
            ],
            [
                'name' => 'Ngô Quang Vinh',
                'gender' => 'male',
                'dob' => '2002-08-29',
                'email' => 'vinhngo@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=vinhngo',
            ],
            [
                'name' => 'Phạm Ngọc Ánh',
                'gender' => 'female',
                'dob' => '2000-01-03',
                'email' => 'anhpham@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=anhpham',
            ],
            [
                'name' => 'Lý Hoàng Nam',
                'gender' => 'male',
                'dob' => '1998-11-22',
                'email' => 'namly@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=namly',
            ],
            [
                'name' => 'Đỗ Thị Thanh Hương',
                'gender' => 'female',
                'dob' => '1997-05-27',
                'email' => 'huongdo@example.com',
                'profile_url' => 'https://testingbot.com/free-online-tools/random-avatar/200?u=huongdo',
            ],
        ];

        foreach ($people as $person) {
            $province = VietnamAddress::randomProvince();
            $ward = VietnamAddress::randomWard($province['province_code']);

            $personalInfo = PersonalInfo::create([
                'name' => $person['name'],
                'gender' => $person['gender'],
                'date_of_birth' => $person['dob'],

                'house_number' => $this->houseNumber(),
                'ward' => $ward['name'],
                'province' => $province['name'],
                
                'email' => $person['email'],
                'phone_number' => $this->phone(),
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

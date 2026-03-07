<?php

namespace App\Helpers;

use VietnamAddressDatabase\VietnamAddressDatabase;

class VietnamAddress{
    public static function randomProvince(){
        $provinces = VietnamAddressDatabase::getProvinces();
        return collect($provinces)->random();
    }

    public static function randomWard($provinceCode){
        $wards = VietnamAddressDatabase::getWardsByProvinceCode($provinceCode);
        return collect($wards)->random();
    }
}
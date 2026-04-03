<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinceCollection;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\WardCollection;
use App\Http\Resources\WardResource;
use Illuminate\Http\Request;
use VietnamAddressDatabase\VietnamAddressDatabase;

class AddressController extends Controller
{
    
    public function getProvinces()
    {
        return new ProvinceCollection(VietnamAddressDatabase::getProvinces());
    }

    public function getWards()
    {
        return new WardCollection(VietnamAddressDatabase::getWards());
    }

    public function getWardsFromProvinceCode($provinceCode)
    {
        return new WardCollection(VietnamAddressDatabase::getWardsByProvinceCode($provinceCode));
    }

    public function getWardsFromProvinceName($provinceName){
        $provinces = VietnamAddressDatabase::getProvinces();
        foreach ($provinces as $province) {
            if (isset($province['name']) && $province['name'] === $provinceName) {
                return new WardCollection(VietnamAddressDatabase::getWardsByProvinceCode($province['province_code']));
            }
        }
        return response()->json(['error' => 'Wards not found']);
    }

    public function getProvinceByCode($provinceCode)
    {
        return new ProvinceResource(VietnamAddressDatabase::getProvinceByCode($provinceCode));
    }

    public function getProvinceByName($provinceName){
        $provinces = VietnamAddressDatabase::getProvinces();
        foreach ($provinces as $province) {
            if (isset($province['name']) && $province['name'] === $provinceName) {
                return new ProvinceResource($province);
            }
        }
        return response()->json(['error' => 'Province not found']);
    }

    public function getWardByCode($wardCode)
    {
        return new WardResource(VietnamAddressDatabase::getWardByCode($wardCode));
    }

    public function getWardByName($wardName){
        $wards = VietnamAddressDatabase::getWards();
        foreach ($wards as $ward) {
            if (isset($ward['name']) && $ward['name'] === $wardName) {
                return new WardResource($ward);
            }
        }
        return response()->json(['error' => 'Ward not found']);
    }
}

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
    private $allowedIncludes = [
        'permissions',
    ];

    private $allowSorts = [
        'id',
    ];

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

    public function getProvinceByCode($provinceCode)
    {
        return new ProvinceResource(VietnamAddressDatabase::getProvinceByCode($provinceCode));
    }

    public function getWardByCode($wardCode)
    {
        return new WardResource(VietnamAddressDatabase::getWardByCode($wardCode));
    }
}

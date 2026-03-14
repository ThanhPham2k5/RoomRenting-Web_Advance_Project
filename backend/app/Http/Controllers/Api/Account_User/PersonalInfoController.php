<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\PersonalInfoFilter;
use App\Models\Account_User\PersonalInfo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonalInfoRequest;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Http\Resources\Account_User\PersonalInfoCollection;
use App\Http\Resources\Account_User\PersonalInfoResource;
use Illuminate\Http\Request;

class PersonalInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PersonalInfoFilter();
        $queryItems = $filter->transform($request);

        if(count($queryItems) == 0){
            return new PersonalInfoCollection(PersonalInfo::paginate());
        }
        $PersonalInfos = PersonalInfo::where($queryItems)->paginate();
        return new PersonalInfoCollection($PersonalInfos->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonalInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonalInfo $personalInfo)
    {
        return new PersonalInfoResource($personalInfo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonalInfoRequest $request, PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalInfo $personalInfo)
    {
        //
    }
}

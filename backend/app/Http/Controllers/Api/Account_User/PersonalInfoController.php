<?php

namespace App\Http\Controllers\Api\Account_User;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Account_User\PersonalInfo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonalInfoRequest;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Http\Resources\Account_User\PersonalInfoCollection;
use App\Http\Resources\Account_User\PersonalInfoResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PersonalInfoController extends Controller
{
    use AuthorizesRequests;

    private $allowedIncludes = [
        'user',
        'employee',
        'user.account',
        'employee.account'
    ];

    private $allColFilter = [
        'gender',
        'houseNumber' => 'house_number',
        'ward',
        'province',
        'name',
        'pid',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(PersonalInfo::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::operator('gender', FilterOperator::DYNAMIC), // =, <>
            AllowedFilter::partial('houseNumber', 'house_number'),
            AllowedFilter::partial('ward'),
            AllowedFilter::partial('province'),
            AllowedFilter::partial('name'),
            AllowedFilter::partial('pid'),
            AllowedFilter::custom('dateOfBirth', new DateFilter(), 'date_of_birth'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('dateOfBirth', 'date_of_birth'),
        ]);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $PersonalInfos = $query->get();
        } else {
            $PersonalInfos = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new PersonalInfoCollection($PersonalInfos);
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
        $this->authorize('view', $personalInfo);

        $personalInfo = QueryBuilder::for(PersonalInfo::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($personalInfo->id);

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
        
        $this->authorize('update', $personalInfo);

        $validated = $request->validated();

        // Handle profile image upload
        if ($request->hasFile('profile_url')) {

            // delete old image (if exists)
            if ($personalInfo->profile_url) {
                Storage::disk('public')->delete($personalInfo->profile_url);
            }

            $image = $request->file('profile_url');

            // Rename to avatar
            $filename = 'avatar.' . $image->getClientOriginalExtension();

            if($personalInfo->user){
                // store new image
                $path = $image->storeAs(
                    "profiles/{$personalInfo->user->account_id}",
                    $filename,
                    "public"
                );
            }else{
                // store new image
                $path = $image->storeAs(
                    "profiles/{$personalInfo->employee->account_id}",
                    $filename,
                    "public"
                );
            }

            $validated['profile_url'] = $path;
        }


        $personalInfo->update($validated);

        return response()->json([
            'message' => 'Personal Info update successfully',
            'personalInfo' => new PersonalInfoResource($personalInfo)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalInfo $personalInfo)
    {
        //
    }
}

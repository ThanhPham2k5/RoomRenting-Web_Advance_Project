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
use App\Models\Account_User\Account;
use App\Services\PersonalInfoService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PersonalInfoController extends Controller
{
    use AuthorizesRequests;

    private PersonalInfoService $personalInfoService;

    public function __construct(PersonalInfoService $personalInfoService)
    {
        $this->personalInfoService = $personalInfoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->personalInfoService->buildGetAllQuery();

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

        $personalInfo = $this->personalInfoService->getPersonalInfo($personalInfo);

        return new PersonalInfoResource($personalInfo);
    }

    //via account_id
    public function showByAccountId(Account $account)
    {
        if($account->user){
            $personalInfo = $account->user->personalInfo;
        } else if($account->employee){
            $personalInfo = $account->employee->personalInfo;
        }

        $this->authorize('view', $personalInfo);

        $personalInfo = $this->personalInfoService->getPersonalInfo($personalInfo);
        
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

        return DB::transaction(function () use ($request, $personalInfo, $validated) {
            $this->getProfileFromRequest($request, $personalInfo);

            $result = $this->personalInfoService->updatePersonalInfo($personalInfo, $validated);

            return response()->json($result);
        });
    }

    // via account_id
    public function updateByAccountId(UpdatePersonalInfoRequest $request, Account $account)
    {
        if($account->user){
            $personalInfo = $account->user->personalInfo;
        } else if($account->employee){
            $personalInfo = $account->employee->personalInfo;
        }

        $this->authorize('update', $personalInfo);

        $validated = $request->validated();

        return DB::transaction(function () use ($request, $personalInfo, $validated) {
            $this->getProfileFromRequest($request, $personalInfo);

            $result = $this->personalInfoService->updatePersonalInfo($personalInfo, $validated);

            return response()->json($result);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalInfo $personalInfo)
    {
        //
    }

    private function getProfileFromRequest($request, $personalInfo){
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
    }
}

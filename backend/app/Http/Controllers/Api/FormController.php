<?php

namespace App\Http\Controllers\Api;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Posts\PostResource;
use App\Models\Form;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Http\Resources\FormCollection;
use App\Http\Resources\FormResource;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Posts\Post;
use App\Http\Resources\Posts\PostCollection;
use App\Models\Account_User\Account;
use App\Services\FormService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FormController extends Controller
{
    use AuthorizesRequests;
    
    private FormService $formService;

    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->formService->buildGetAllQuery();

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $Forms = $query->get();
        } else {
            $Forms = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new FormCollection($Forms);
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
    public function store(StoreFormRequest $request)
    {
        // $user = $request->user();
        // if (Form::where('account_id', $user->id)->exists()) {
        //     return response()->json([
        //         'message' => 'You already have a form. Please update it instead.'
        //     ], 400);
        // }

        // $validated = $request->validated();
        
        // $validated['account_id'] = $user->id;

        // $form = Form::create($validated);

        // return response()->json([
        //     'message' => 'Form created successfully',
        //     'form' => new FormResource($form)
        // ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        $this->authorize('view', $form);

        $form = $this->formService->getForm($form);

        return new FormResource($form);
    }

    public function showByAccountId(Account $account)
    {
        $form = $account->form;

        $this->authorize('view', $form);

        $form = $this->formService->getForm($form);

        return new FormResource($form);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormRequest $request, Form $form)
    {
        $this->authorize('update', $form);

        $validated = $request->validated();

        $result = $this->formService->updateForm($form, $validated);

        return response()->json($result);
    }

    public function updateByAccountId(UpdateFormRequest $request, Account $account)
    {
        $form = $account->form;

        $this->authorize('update', $form);

        $validated = $request->validated();

        $result = $this->formService->updateForm($form, $validated);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        // $form->delete();

        // return response()->json([
        //     'message' => 'Form deleted successfully'
        // ]);
    }

    /*
     * Get recommended posts based on user's form criteria
    */
    public function getRecommendedPosts(Request $request)
    {
        $user = $request->user();

        $result = $this->formService->getRecommendedPosts($user);

        return response()->json($result);
    }

}

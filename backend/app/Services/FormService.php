<?php
namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\FormResource;
use App\Http\Resources\Posts\PostResource;
use App\Models\Form;
use App\Models\Posts\Post;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class FormService {
    private $allowedIncludes = [
        'account',
    ];

    private $allColFilter = [
        'ward',
        'province',
        'roomType' => 'room_type'
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Form::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::exact('account.id'),
            AllowedFilter::operator('priceMax', FilterOperator::DYNAMIC, '', 'price_max'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('priceMin', FilterOperator::DYNAMIC, '', 'price_min'), // =, <>, >, <, >=, <=
            AllowedFilter::operator('area', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('ward'),
            AllowedFilter::partial('province'),
            AllowedFilter::exact('roomType', 'room_type'),
            AllowedFilter::operator('maxOccupants', FilterOperator::DYNAMIC, '', 'max_occupants'), // =, <>, >, <, >=, <=
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('priceMax','price_max'),
            AllowedSort::field('priceMin','price_min'),
            'area',
            AllowedSort::field('maxOccupants','max_occupants'),
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getForm($form){
        $form = QueryBuilder::for(Form::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($form->id);
        
        return $form;
    }

    public function updateForm($form, $data){
        $form->update($data);

        return [
            'message' => 'Form updated successfully',
            'form' => new FormResource($form)
        ];
    }

    // public function getRecommendedPosts($account){
    //     $form = Form::where('account_id', $account->id)->first();

    //     if (!$form) {
    //         return response()->json([
    //             'message' => 'You need to create a form first to get recommendations'
    //         ], 404);
    //     }

    //     $query = Post::query()
    //         // No need to recommend user's own posts
    //         ->where('user_id', '!=', $account->user->id);

    //     // build query from query builder

    //     // FILTERS
    //     $query->when($form->price_min, fn($q) =>
    //         $q->where('price', '>=', $form->price_min)
    //     );

    //     $query->when($form->price_max, fn($q) =>
    //         $q->where('price', '<=', $form->price_max)
    //     );

    //     $query->when($form->area, function ($q) use ($form) {
    //         $percent = 0.2; // ±20%

    //         $min = $form->area * (1 - $percent);
    //         $max = $form->area * (1 + $percent);

    //         $q->whereBetween('area', [$min, $max]);
    //     });

    //     $query->when($form->ward, fn($q) =>
    //         $q->where('ward', 'like', "%{$form->ward}%")
    //     );

    //     $query->when($form->province, fn($q) =>
    //         $q->where('province', 'like', "%{$form->province}%")
    //     );

    //     $query->when($form->room_type, fn($q) =>
    //         $q->where('room_type', $form->room_type)
    //     );

    //     $query->when($form->max_occupants, fn($q) =>
    //         $q->where('max_occupants', '>=', $form->max_occupants)
    //     );

    //     if ($query->count() === 0) {
    //         return response()->json([
    //             'message' => 'No recommended posts found based on your form criteria'
    //         ], 404);
    //     }

    //     $posts = $query
    //         ->latest()
    //         ->get();

    //     // Returning all posts
    //     return [
    //         'message' => 'Recommended posts fetched successfully',
    //         'data' => PostResource::collection($posts)
    //     ];
    // }
}

?>
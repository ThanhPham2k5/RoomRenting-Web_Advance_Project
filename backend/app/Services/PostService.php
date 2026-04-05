<?php

namespace App\Services;

use App\Events\PayBillCreated;
use App\Events\PostCreated;
use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\Posts\PostResource;
use App\Models\Payments\PayBill;
use App\Models\Payments\PayRule;
use App\Models\Posts\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class PostService{
    private $allowedIncludes = [
        'user',
        'user.personalInfo',
        'employee',
        'postImages',
        'comments',
        'comments.account',
        'payBills',
        'favorites.account',
        'notifications'
    ];

    private $allColFilter = [
        'title',
        'houseNumber' => 'house_number',
        'ward',
        'province',
        'description',
        'status',
        'roomType' => 'room_type'
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Post::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::exact('user.account_id'),
            AllowedFilter::exact('employee.account_id'),
            AllowedFilter::exact('favoritedBy', 'favorites.account_id'),
            AllowedFilter::partial('title'),
            AllowedFilter::operator('price', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('area', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('houseNumber', 'house_number'),
            AllowedFilter::partial('ward'),
            AllowedFilter::partial('province'),
            AllowedFilter::partial('description'),
            AllowedFilter::operator('deposit', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::exact('status'),
            AllowedFilter::operator('authorized', FilterOperator::DYNAMIC), // =, <>
            AllowedFilter::exact('roomType', 'room_type'),
            AllowedFilter::operator('maxOccupants', FilterOperator::DYNAMIC, '', 'max_occupants'), // =, <>, >, <, >=, <=
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'price',
            'area',
            'deposit',
            AllowedSort::field('maxOccupants','max_occupants'),
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getPost($post){
        $post = QueryBuilder::for(Post::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($post->id);

        return $post;
    }

    public function createPost($data){

        //
    }

    public function updatePost($post, $data){
        $post->update($data);

        // delete specified orders and files
        if (!empty($data['deleted_orders'])) {
            foreach ($data['deleted_orders'] as $orderToDelete) {
                $image = $post->postImages()->where('order', $orderToDelete)->first();
                if ($image) {
                    Storage::disk('public')->delete($image->image_post_url);
                    $image->forceDelete();
                }
            }
        }

        // If status changed to 'completed', fire PostCreated event
        if (isset($data['status']) && $data['status'] === 'completed') {
            event(new PostCreated($post));
        }

        if (isset($data['postImages'])) {
            foreach ($data['postImages'] as $imgData) {
                $file = $imgData['file'];
                $order = $imgData['order'];

                // Tìm ảnh cũ tại order này (nếu có)
                $oldImage = $post->postImages()->where('order', $order)->first();

                if ($oldImage) {
                    // Nếu đã có ảnh ở order này, xóa file cũ trước khi cập nhật URL mới
                    Storage::disk('public')->delete($oldImage->image_post_url);
                } 

                $filename = $order . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs("posts/{$post->id}/images", $filename, "public");
                
                if($oldImage){
                    // Cập nhật URL mới cho ảnh cũ
                    $oldImage->update(['image_post_url' => $path]);
                }else {
                    // Nếu chưa có, tạo mới
                    $post->postImages()->create([
                        'order' => $order,
                        'image_post_url' => $path
                    ]);
                }
            }
        }

        return $post->load('postImages');
    }

    public function deletePost($post){
        return DB::transaction(function () use ($post) {
            $post->postImages()->delete();
            $post->comments()->delete();
            $post->favorites()->delete();
            $post->delete();

            return [
                'message' => 'Post deleted successfully'
            ];
        });   
    }

    public function restorePost($id){
        return DB::transaction(function () use ($id) {
            $post = Post::onlyTrashed()->findOrFail($id);
    
            $post->postImages()->restore();
            $post->comments()->restore();
            $post->favorites()->restore();
            $post->restore();
    
            return [
                'message' => 'Post restored successfully',
                'post'    => new PostResource($post->load('postImages')),
            ];
        }); 
    }

    public function getQueryRecommendedPosts($form, $account){
        
        $baseQuery = Post::withTrashed()
            ->where('user_id', '!=', $account->user->id)
            ->matchWithForm($form) // scope in Post model to filter posts matching form criteria
            ->where('status', 'completed'); // Only recommend completed posts

        // build query from query builder
        $query = QueryBuilder::for($baseQuery)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filter
            AllowedFilter::exact('id'),
            AllowedFilter::exact('user.account_id'),
            AllowedFilter::exact('employee.account_id'),
            AllowedFilter::exact('favoritedBy', 'favorites.account_id'),
            AllowedFilter::partial('title'),
            AllowedFilter::operator('price', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::operator('area', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::partial('houseNumber', 'house_number'),
            AllowedFilter::partial('ward'),
            AllowedFilter::partial('province'),
            AllowedFilter::partial('description'),
            AllowedFilter::operator('deposit', FilterOperator::DYNAMIC), // =, <>, >, <, >=, <=
            AllowedFilter::exact('status'),
            AllowedFilter::operator('authorized', FilterOperator::DYNAMIC), // =, <>
            AllowedFilter::exact('roomType', 'room_type'),
            AllowedFilter::operator('maxOccupants', FilterOperator::DYNAMIC, '', 'max_occupants'), // =, <>, >, <, >=, <=
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            'price',
            'area',
            'deposit',
            AllowedSort::field('maxOccupants','max_occupants'),
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function postPayment(Post $post)
    {
        $user = $post->user;
        $payRule = PayRule::first();
        $points = $payRule->points;
        $payRule = PayRule::firstOrFail();

        if ($user->points > $points) {
            $user->decrement('points', $points);
                $paybill = PayBill::create([
                    'account_id' => $user->account->id,
                    'status' => 'completed',
                    'points' => $points,
                    'pay_rule_id' => $payRule->id,
                    'post_id' => $post->id,
                ]);

            $post->update(['status' => 'completed',
                'next_payment_date' => now()->addMonth()]);
            event(new PayBillCreated($paybill));

        } else {
            return [
                'message' => 'Tài khoản của bạn không đủ điểm.'
            ];
        }

        return [
            'message' => 'Thanh toán thành công.',
        ];

    }
}
?>
<?php

namespace App\Models\Posts;

use App\Models\Account_User\Account;
use App\Models\Account_User\Employee;
use App\Models\Account_User\User;
use App\Models\Notification\Notification;
use App\Models\Payments\PayBill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'description', 'price', 'area', 'house_number', 'ward',
                            'province', 'deposit', 'status', 'authorized', 'user_id', 'employee_id', 'room_type', 'max_occupants', 'next_payment_date'];

    protected static function newFactory()
    {
        return \Database\Factories\PostFactory::new();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function postImages(){
        return $this->hasMany(PostImage::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function payBills(){
        return $this->hasMany(PayBill::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    
    public function scopeMatchWithForm($query, $form)
    {
        $margin = 0.35; // Sai số 35%

        return $query->where(function ($q) use ($form, $margin) {
            // 1. Luôn ưu tiên cùng Tỉnh/Thành phố (Điều kiện này nên giữ là AND để tránh gợi ý quá xa)
            $q->where('province', 'like', "%{$form->province}%");

            // 2. Các yếu tố còn lại dùng OR để "vét" bài đăng
            $q->where(function ($sub) use ($form, $margin) {
                // Khớp Phường/Xã
                if ($form->ward) {
                    $sub->orWhere('ward', 'like', "%{$form->ward}%");
                }

                // Khớp loại phòng
                if ($form->room_type) {
                    $sub->orWhere('room_type', $form->room_type);
                }

                // Khớp trong khoảng giá (có sai số)
                if ($form->price_min || $form->price_max) {
                    $min = $form->price_min ? $form->price_min * (1 - $margin) : 0;
                    $max = $form->price_max ? $form->price_max * (1 + $margin) : 9999999999;
                    $sub->orWhereBetween('price', [$min, $max]);
                }

                // Khớp diện tích (có sai số)
                if ($form->area) {
                    $sub->orWhereBetween('area', [
                        $form->area * (1 - $margin), 
                        $form->area * (1 + $margin)
                    ]);
                }

                // Khớp số người ở
                if ($form->max_occupants) {
                    $sub->orWhereBetween('max_occupants', [
                        $form->max_occupants - 1, 
                        $form->max_occupants + 1
                    ]);
                }
            });
        });
    }
}

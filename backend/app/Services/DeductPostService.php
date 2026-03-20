<?php

namespace App\Services;
use App\Events\PayBillCreated;
use App\Models\Payments\PayRule;
use App\Models\Payments\PayBill;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Events\PostDeducted;

class DeductPostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle($post)
    {
        DB::transaction(function () use ($post) {
            $user = $post->user;
            $account = $user->account;
            $payRule = PayRule::first();
            $points = $payRule->points;
            
            // Check if the user has enough points to pay for the post
            if ($user->points < $points) {
                
                $paybill = PayBill::create([
                    'account_id' => $account->id,
                    'status' => 'failed',
                    'points' => $points,
                    'pay_rule_id' => $payRule->id,
                    'post_id' => $post->id,
                ]);

                $post->update(['status' => 'expired']);
                
                event(new PayBillCreated($paybill));
            }
            // If the user has enough points, deduct the points and create a pay bill
            else {
                $user->decrement('points', $points);
                $paybill = PayBill::create([
                    'account_id' => $user->account->id,
                    'status' => 'completed',
                    'points' => $points,
                    'pay_rule_id' => $payRule->id,
                    'post_id' => $post->id,
                ]);
                // Update the next payment date for the post
                $post->update([
                    'next_payment_date' => Carbon::parse($post->next_payment_date)->addMonth()
                ]);
                if ($post->status == 'expired') {
                    $post->update(['status' => 'completed']);
                    $post->update([
                        'next_payment_date' => Carbon::parse($post->next_payment_date)->now()->addMonth()
                    ]);
                }

                event(new PayBillCreated($paybill));
            }
            


        });
    }
}

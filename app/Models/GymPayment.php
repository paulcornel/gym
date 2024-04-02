<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\GymMembers;
use App\Models\GymPayment;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GymPayment extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'gym_payment';

    protected $fillable = [
        'gym_members_id',
        'amount',
        'type',
        'transaction_code',
        'payment_for'
    ];

    public function gym_members()
    {
        return $this->belongsTo(GymMembers::class, 'gym_members_id');
    }

protected static function booted()
{
    static::saving(function ($payment) {
        // Initialize default start date for any subscription or payment
        $startDate = now();
        $endDate = now();

        // Handling 'annual' payment separately
        if ($payment->payment_for === 'annual') {
            $endDate = $startDate->copy()->addYear();

            $payment->gym_members->memberships()->updateOrCreate(
                ['gym_members_id' => $payment->gym_members_id], // Assuming this identifies the record uniquely
                
                   [ 'annual_start_date' => $startDate,
                    'annual_end_date' => $endDate,
                    'annual_status' => 'active', // Only annual status is active
                    // 'subscription_status' => 'inactive', // No need to modify subscription status for annual payments
                    
                ]
            );
        } else {
            // For non-annual payments, determine the end date based on the payment type
            switch ($payment->payment_for) {
                case 'monthly':
                    $endDate = $startDate->copy()->addMonth();
                    break;
                case 'session':
                        $endDate = $startDate->copy()->addMonth();
                        break;
                case 'bi_monthly':
                    $endDate = $startDate->copy()->addMonths(2);
                    break;
                case '6_months':
                    $endDate = $startDate->copy()->addMonths(6);
                    break;
                case '1_year':
                    // Treat '1 year' as a subscription type here, not as 'annual'
                    $endDate = $startDate->copy()->addYear();
                    break;
            }

            // Update or create a membership record with appropriate dates and status
            $payment->gym_members->memberships()->updateOrCreate(
                ['gym_members_id' => $payment->gym_members_id],
                
                [    'subscription_start_date' => $startDate,
                    'subscription_end_date' => $endDate,
                    'subscription_status' => 'active', // Only annual status is active
                    // 'subscription_status' => 'inactive', // No need to modify subscription status for annual payments
                ]
            );
        }
    });
}

}
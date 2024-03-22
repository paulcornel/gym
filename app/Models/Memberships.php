<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberships extends Model

{
    use CrudTrait;
    use HasFactory;

    protected $table = 'memberships';
    protected $fillable = [
        'gym_members_id',
        'gym_payment_id',
        'date_start_effectivity',
        'date_end_effectivity',
        'annual_start_date',
        'annual_end_date',
        'annual_status',
        'subscription_start_date',
        'subscription_end_date',
        'subscription_status'
    ];

    


    protected $casts = [
        'annual_status' => 'string',
        'subscription_status' => 'string'
    ];

    public function gymMember()
    {
        return $this->belongsTo(GymMembers::class, 'gym_members_id'); // specify the foreign key
    }
}




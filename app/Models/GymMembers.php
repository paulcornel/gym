<?php

namespace App\Models;

use App\Models\Memberships;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GymMembers extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'gym_members';
    protected $fillable = [ // Add 'members_code' to the fillable attributes
        'first_name',
        'last_name',
        'contact_number',
        'email',
    ];

    // Automatically generate members_code before saving if it's not provided
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gymMember) {
            $latestMember = static::latest()->first();
            $latestId = $latestMember ? $latestMember->id : 0;
            $gymMember->members_code = now()->format('md') . '-' . str_pad($latestId + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // public function getAnnualStatusAttribute()
    // {
    //     return $this->memberships->annual;
    // }

    public function payments()
    {
        return $this->hasMany(GymPayment::class, 'gym_members_id');
    }

    public function checkins()
    {
        return $this->hasMany(GymCheckIns::class, 'gym_members_id');
    }

    public function memberships()
    {
        return $this->hasOne(Memberships::class, 'gym_members_id');
    }
}   



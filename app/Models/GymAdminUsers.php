<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymAdminUsers extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'gym_admin_users';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password'
    ];
}

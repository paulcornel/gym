<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymCheckIns extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'gym_check_ins';
    protected $fillable = [
        'gym_members_id',
        'check_in_datetime'
    ];
    
    public function member()
    {
        return $this->belongsTo(GymMembers::class, 'gym_members_id');
    }

}


// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\GymCheckIns; // Import the GymCheckIns model

// class SearchController extends Controller
// {
//     public function checkins(Request $request)
//     {
//         // Retrieve member ID from the request
//         $memberId = $request->input('member_id');

//         // If member ID is provided, filter check-ins for that member
//         if ($memberId) {
//             $checkins = GymCheckIns::where('gym_members_id', $memberId)->get();
//         } else {
//             // If no member ID is provided, fetch all check-ins
//             $checkins = GymCheckIns::all();
//         }

//         // Pass the retrieved check-ins to the view
//         return view('checkin', ['checkins' => $checkins]);
//     }
// }  









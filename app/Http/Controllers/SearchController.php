<?php

namespace App\Http\Controllers;

use App\Models\GymMembers;
use App\Models\GymCheckIns;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function view(Request $request)
    {
        return view('checkin');
    }
    public function process(Request $request)
    {
        $query = $request->input('query');
        $members = GymMembers::where('members_code', 'like', '%' . $query . '%')->get();

        if ($members->isNotEmpty()) { // Check if any members are found
            $checkin = new GymCheckIns();
            // Assuming you want to check in each member found
            foreach ($members as $member) {
                $checkin->gym_members_id = $member->id;
                $checkin->save();
            }
        }

        return view('checkin', ['members' => $members, 'success' => 'Data Retrieved Successfully']);
    }


    // public function autoCheckin(Request $request)
    // {
    //     $memberId = $request->input('member_id');
    //     $checkinTime = now(); // Assuming you want to record the check-in time as the current time

    //     // Create a new GymCheckin record
    //     $checkin = new GymCheckin();
    //     $checkin->member_id = $memberId;
    //     $checkin->check_in_datetime = $checkinTime;
    //     $checkin->save();

    //     return redirect()->back()->with('success', 'Member checked in successfully.');
    // }
}

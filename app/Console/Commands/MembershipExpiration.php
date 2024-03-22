<?php

namespace App\Console\Commands;

use App\Models\Memberships;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class MembershipExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:membership-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $memberships_status = Memberships::where('annual_end_date', '<', Carbon::today())->get();
        foreach ($memberships_status as $mem){
            Memberships::where('id', $mem->id)
                ->update(['annual_status' => "cancelled"]);
        }
    
        $memberships_status = Memberships::where('subscription_end_date', '<', Carbon::today())->get();
        foreach ($memberships_status as $mem){
            Memberships::where('id', $mem->id)
                ->update(['subscription_status' => "inactive"]);
        }
    }    
 }


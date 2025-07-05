<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateUserLocations extends Command
{
    protected $signature = 'location:update';
    protected $description = 'Auto update user locations every 5 minutes';

    public function handle()
    {
        $users = DB::table('users')->get(); // Assuming you have a users table

        foreach ($users as $user) {
            DB::table('user_locations')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'latitude' => 12.3456, // Replace with logic for real data
                    'longitude' => 65.4321,
                    'updated_at' => Carbon::now()
                ]
            );
        }

        $this->info('User locations updated at ' . Carbon::now());
    }

}

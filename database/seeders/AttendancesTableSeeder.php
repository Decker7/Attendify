<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all user IDs and event IDs
        $userIds = DB::table('users')->pluck('id')->toArray();
        $eventIds = DB::table('events')->pluck('id')->toArray();

        // Possible statuses
        $statuses = ['registered', 'present', 'absent'];

        // Track user-event combinations to prevent duplicates
        $usedCombinations = [];

        // Seed attendances for each event
        foreach ($eventIds as $eventId) {
            foreach ($userIds as $userId) {
                // Check if this user-event combination is already used
                if (isset($usedCombinations["$eventId-$userId"])) {
                    continue;
                }

                // Insert the attendance record
                DB::table('attendances')->insert([
                    'user_id' => $userId,
                    'event_id' => $eventId,
                    'status' => $statuses[array_rand($statuses)], // Random status
                ]);

                // Mark the combination as used
                $usedCombinations["$eventId-$userId"] = true;
            }
        }

        $this->command->info('Attendances table seeded successfully without duplicates.');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvitationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all event IDs
        $eventIds = DB::table('events')->pluck('id')->toArray();

        // Define user emails based on the provided user seeder
        $userEmails = [
            'admin@example.com',
            'user@example.com',
            'jasmin.deckow@example.org',
            'carter41@example.com',
            'gilberto99@example.org',
            'floy.murazik@example.org',
            'donnie.schamberger@example.com',
        ];

        // Track user-event combinations to prevent duplicates
        $usedCombinations = [];

        // Seed invitations for each event
        foreach ($eventIds as $eventId) {
            foreach ($userEmails as $email) {
                // Check if this user-event combination is already used
                if (isset($usedCombinations["$eventId-$email"])) {
                    continue;
                }

                // Insert the invitation
                DB::table('invitations')->insert([
                    'event_id' => $eventId,
                    'email' => $email,
                ]);

                // Mark the combination as used
                $usedCombinations["$eventId-$email"] = true;
            }
        }

        $this->command->info('Invitations table seeded successfully without duplicates.');
    }
}

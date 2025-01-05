<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the EventsTableSeeder
        $this->call([
            UserSeeder::class,
            EventsTableSeeder::class,   // Ensure events are seeded
            AttendancesTableSeeder::class,
            InvitationsTableSeeder::class,

        ]);
    }
}

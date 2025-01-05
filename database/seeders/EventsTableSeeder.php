<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data into the events table
        DB::table('events')->insert([
            [
                'name' => 'Annual Tech Conference',
                'description' => 'A conference focusing on the latest advancements in technology.',
                'date' => '2025-02-15',
                'location' => 'Convention Center, Kuala Lumpur',
            ],
            [
                'name' => 'Summer Coding Workshop',
                'description' => 'A hands-on workshop for beginners to learn coding.',
                'date' => '2025-06-20',
                'location' => 'Tech Hub, Penang',
            ],
            [
                'name' => 'Startup Pitch Competition',
                'description' => 'An event for startups to pitch their ideas to potential investors.',
                'date' => '2025-04-10',
                'location' => 'Innovation Center, Selangor',
            ],
            [
                'name' => 'AI and Machine Learning Symposium',
                'description' => 'A symposium exploring the applications of AI and ML in various industries.',
                'date' => '2025-03-25',
                'location' => 'Science Park, Johor',
            ],
            [
                'name' => 'Cybersecurity Awareness Seminar',
                'description' => 'A seminar highlighting the importance of cybersecurity in the digital age.',
                'date' => '2025-01-30',
                'location' => 'Digital Campus, Terengganu',
            ],
        ]);
    }
}

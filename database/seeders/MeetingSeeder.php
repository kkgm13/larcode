<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meeting::factory()
            ->count(10)
            ->create(); 
    }
}

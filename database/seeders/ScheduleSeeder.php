<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = Meeting::all();
        Schedule::factory()
            ->create(5)
            ->for($test)
            ->create();
    }
}

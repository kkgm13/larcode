<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3,true),
            'start'=> $this->faker->dateTimeBetween('-1 month','+1 Year'),
            // Allow The duration to use the Time format
            'duration' => gmdate('H:i:s', floor($this->faker->randomDigit() * 3600)),
        ];
    }
}

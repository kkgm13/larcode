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
        // $time = Carbon::setTime($this->faker->randomDigit(), 0, 0);
        
        return [
            'title' => $this->faker->words(3,true),
            'start'=> $this->faker->dateTimeBetween('+1 month','+1 Year'),
            // 'duration' => $time,
            'duration' => $this->faker->randomDigit(),
        ];
    }
}

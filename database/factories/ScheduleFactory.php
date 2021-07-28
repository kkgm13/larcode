<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $result = null;
        $bool = $this->faker->boolean();
        if($bool == true) {
            $result = $this->faker->numberBetween(1,30);
        }
        return [
            'meetID' => $this->faker->randomDigit(),
            'isRepeat' => $bool,
            'start'=> $this->faker->dateTimeBetween('-1 month','+1 Year'),
            'duration' => gmdate('H:i:s', floor($this->faker->randomDigit() * 3600)),
            'repDays' => $result
        ];
    }
}

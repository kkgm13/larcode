<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Meeting;

class MeetingTest extends TestCase
{
    use RefreshDatabase;

    // protected $meet1, $meet2;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_add_single_meeting(){
        $meet1 = [
            'title' => "Meeting 1",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-10T16:00',
                'duration' => 50,
                'repDays' => null
            ]
        ];

        Meeting::create($meet1);

        $this->assertCount(1, Meeting::all());
        $this->assertDatabaseHas('meetings', [
            'title' => $meet1['title']
        ]);
    }

    public function test_add_repeat_meeting(){
        $meet1 = [
            'title' => "Meeting 2",
            'schedule' => [
                'isRepeat' => true,
                'start' => '2021-10-10T16:00',
                'duration' => 50,
                'repDays' => 5
            ]
        ];

        Meeting::create($meet1);

        $this->assertCount(1, Meeting::all());
        $this->assertDatabaseHas('meetings', [
            'title' => $meet1['title']
        ]);
    }
}
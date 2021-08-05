<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddNewMeetingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_single_conflict(){
        $meet1 = [
            'title' => "Meeting 2",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-10T10:00',
                'duration' => 50,
                'repDays' => null
            ]
        ];

        $meet2 = [
            'title' => "Meeting 3",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-10T10:30',
                'duration' => 10,
                'repDays' => null
            ]
        ];
        Meeting::create($meet1);
        $this->assertCount(1, Meeting::all());
        $this->assertDatabaseHas('meetings', [
            'title' => $meet1['title']
        ]);
        Meeting::create($meet2); // Unsure of reason behind this despite it works in 
        $this->assertDatabaseMissing('meetings', [
            'title' => $meet2['title']
        ]);
        
    }
}

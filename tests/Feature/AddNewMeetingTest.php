<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Meeting;

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

    public function test_single_conflict_ending(){
        $meet1 = [
            'title' => "Standard Meet1",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-13T10:00',
                'duration' => 50,
                'repDays' => null
            ]
        ];

        $meet2 = [
            'title' => "Standard Meet2",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-13T10:45',
                'duration' => 30,
                'repDays' => null
            ]
        ];

        $this->post('/meetings', $meet1);
        $this->assertCount(1, Meeting::all());
        $this->assertDatabaseHas('meetings', [
            'title' => $meet1['title']
        ]);
        $this->assertDatabaseHas('schedules', [
            'start' => $meet1['schedule']['start'],
            'isRepeat' => $meet1['schedule']['isRepeat'],
        ]);

        // This needs to hit conflict() method
        $response = $this->post('/meetings', $meet2); 
        // Check the response of the JSON to hit the error conflict
        $response->assertJson(['err' => 'Error: Meeting Conflict Detected with meeting: Standard Meet1, when creating this meeting.']);
        // Detect Meet2 isnt added in the database
        $this->assertDatabaseMissing('meetings', [
            'title' => $meet2['title']
        ]);
        $this->assertDatabaseMissing('schedules', [
            'start' => $meet2['schedule']['start'],
            'isRepeat' => $meet2['schedule']['isRepeat'],
        ]);
    }

    public function test_single_conflict_outside(){
        $meet1 = [
            'title' => "Standard Meet1",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-13T10:00',
                'duration' => 50,
                'repDays' => null
            ]
        ];

        $meet2 = [
            'title' => "Standard Meet2",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-13T09:30',
                'duration' => 120,
                'repDays' => null
            ]
        ];

        $this->post('/meetings', $meet1);
        $this->assertCount(1, Meeting::all());
        $this->assertDatabaseHas('meetings', [
            'title' => $meet1['title']
        ]);
        $this->assertDatabaseHas('schedules', [
            'start' => $meet1['schedule']['start'],
            'isRepeat' => $meet1['schedule']['isRepeat'],
        ]);

        // This needs to hit conflict() method
        $response = $this->post('/meetings', $meet2); 
        // Check the response of the JSON to hit the error conflict
        $response->assertJson(['err' => 'Error: Meeting Conflict Detected with meeting: Standard Meet1, when creating this meeting.']);
        // Detect Meet2 isnt added in the database
        $this->assertDatabaseMissing('meetings', [
            'title' => $meet2['title']
        ]);
        $this->assertDatabaseMissing('schedules', [
            'start' => $meet2['schedule']['start'],
            'isRepeat' => $meet2['schedule']['isRepeat'],
        ]);
    }

    public function test_single_conflict_exact(){
        $meet1 = [
            'title' => "Standard Meet1",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-13T10:00',
                'duration' => 50,
                'repDays' => null
            ]
        ];

        $meet2 = [
            'title' => "Standard Meet2",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-13T10:00',
                'duration' => 10,
                'repDays' => null
            ]
        ];

        $this->post('/meetings', $meet1);
        $this->assertCount(1, Meeting::all());
        $this->assertDatabaseHas('meetings', [
            'title' => $meet1['title']
        ]);
        $this->assertDatabaseHas('schedules', [
            'start' => $meet1['schedule']['start'],
            'isRepeat' => $meet1['schedule']['isRepeat'],
        ]);

        // This needs to hit conflict() method
        $response = $this->post('/meetings', $meet2); 
        // Check the response of the JSON to hit the error conflict
        $response->assertJson(['err' => 'Error: Meeting Conflict Detected with meeting: Standard Meet1, when creating this meeting.']);
        // Detect Meet2 isnt added in the database
        $this->assertDatabaseMissing('meetings', [
            'title' => $meet2['title']
        ]);
        // $this->assertDatabaseMissing('schedules', [
        //     'start' => $meet2['schedule']['start'],
        //     'isRepeat' => $meet2['schedule']['isRepeat'],
        // ]);
    }

    public function test_single_conflict_within(){
        $meet1 = [
            'title' => "Standard Meet1",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-13T10:00',
                'duration' => 50,
                'repDays' => null
            ]
        ];

        $meet2 = [
            'title' => "Standard Meet2",
            'schedule' => [
                'isRepeat' => false,
                'start' => '2021-10-13T10:30',
                'duration' => 10,
                'repDays' => null
            ]
        ];

        $this->post('/meetings', $meet1);
        $this->assertCount(1, Meeting::all());
        $this->assertDatabaseHas('meetings', [
            'title' => $meet1['title']
        ]);
        $this->assertDatabaseHas('schedules', [
            'start' => $meet1['schedule']['start'],
            'isRepeat' => $meet1['schedule']['isRepeat'],
        ]);

        // This needs to hit conflict() method
        $response = $this->post('/meetings', $meet2); 
        // Check the response of the JSON to hit the error conflict
        $response->assertJson(['err' => 'Error: Meeting Conflict Detected with meeting: Standard Meet1, when creating this meeting.']);
        // Detect Meet2 isnt added in the database
        $this->assertDatabaseMissing('meetings', [
            'title' => $meet2['title']
        ]);
        $this->assertDatabaseMissing('schedules', [
            'start' => $meet2['schedule']['start'],
            'isRepeat' => $meet2['schedule']['isRepeat'],
        ]);
    }
}

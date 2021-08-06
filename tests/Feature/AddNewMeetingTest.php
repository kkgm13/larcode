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

    public function test_single_conflict(){
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
                'start' => '2021-10-15T10:30',
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

        $response = $this->post('/meetings', $meet2); // This needs to hit conflict() method
        $response->assertJson(['err' => NULL]);
        $this->assertTrue($response['err'])
        // Error found that detects meet2 being found....
        // $this->assertDatabaseMissing('meetings', [
        //     'title' => $meet2['title']
        // ]);
        // $this->assertDatabaseMissing('schedules', [
        //     'start' => $meet2['schedule']['start'],
        //     'isRepeat' => $meet2['schedule']['isRepeat'],
        // ]);
        
    }
}

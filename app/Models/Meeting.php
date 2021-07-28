<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'duration',
        'start'
    ];

    /**
     * Look at conflicting Meetings
     */
    public static function conflict($variable){
        // For each meeting in the database
        for ($i=0; $i < Meeting::all(); $i++) { 
            $carbonDate=Carbon::parse($i->schedule->start);
            // If the current meeting's start date time and end time is between the intended variable start date time and duration
            if(Carbon::parse($variable->schedule->start)->between($carbonDate, $carbonDate->addMinutes($i->schedule->duration))){
                // Declare a Meeting Conflict
                dd("Error: Meeting Conflict with ".$i->title.".\nPlease change this meeting.");
            }
        }
        dd("Hit");
        // No conflict found between all dates
    }

    public function schedule(){
        return $this->hasOne(Schedule::class, 'meetId', 'id');
    }

    public static function validationRules(){
        return [
            'title' => 'required|string',
            'start' => 'required|date|after_or_equal:tomorrow',
            'duration' => 'required|integer|numeric|min:1|max:9|between:1.0,9.0'
        ];
    }

    public static function validationMessages(){
        return [
            'title.required' => 'Please name this Scheduled Meeting',
            'start.required' => 'Please provide a starting date and time',
            'start.date'     => 'Please provide a date and time',
            'start.after_or_equal' => 'Please select a meeting date after :date',
            // 'start.unique'   => 'Please reschdule this meeting due to meeting conflict',
        ];
    }

}

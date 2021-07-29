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
        $meetDate = Carbon::parse($variable['schedule']['start']);
        // For each meeting in the database
        foreach(Meeting::with('schedule')->get() as $i){ 
            $carbonDate=Carbon::parse($i->schedule->start);
            // Convert Duration to Seconds to add
            $str_time = $i->schedule->duration;
            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
            $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
            // If the current meeting's start date time and end time is between the intended variable start date time and duration
            $checker = $meetDate->between($carbonDate,Carbon::parse($i->schedule->start)->addSeconds($time_seconds));
            if($checker){
                // Declare a Meeting Conflict
                return "Error: Meeting Conflict Detected with ".$i->title." when creating meeting.\nPlease Retry the meeting.";
            }
        }
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

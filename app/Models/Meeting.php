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
        if($variable['schedule']['isRepeat'] == true){
            $test = self::singleConflict($variable);
            if(is_null($test)){
                return self::multiConflict($variable);
            } else {
                if(!is_null(self::multiConflict($variable))){
                    return $test . " Meeting also contains multiple conflicts on other meetings...";
                } else {
                    return $test;
                }
            }
        } else {
            return self::singleConflict($variable);
        }
    }

    /**
     * Multi-Meeting Conflict Checks
     *  Based on the parameter of isRepeat
     */
    private static function multiConflict($variable){
        $meetDate = Carbon::parse($variable['schedule']['start']);
        if(!empty(Meeting::with('schedule')->get())){
            foreach(Meeting::with('schedule')->get() as $i){
                $mainMeet = $meetDate;
                if($i->schedule->isRepeat == true){
                    // Convert Duration to Seconds to add
                    $str_time = $i->schedule->duration;
                    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                    $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
                    for($j = 0; $j < $variable['schedule']['repDays']; $j++){
                        $meet = $mainMeet->addDays(($variable['schedule']['repDays'] * $j));
                        $meetDBStart = Carbon::parse($i->schedule->start)->addDays(($i->schedule->repDays * $j));
                        $meetDBend = Carbon::parse($i->schedule->start)->addDays(($i->schedule->repDays * $j))->addSeconds($time_seconds);
                        $checker = $meet->between($meetDBStart,$meetDBend);
                        if($checker){
                            return "Error: Meeting Conflict Detected with known meeting on ".$i."th week when creating the meeting.";
                        }
                    }
                }
            }
        }
    }

    /**
     * Single Meeting Conflict Checks
     *   For every known SINGLE entry regardless if it is a repeat
     */
    private static function singleConflict($variable){
        $meetDate = Carbon::parse($variable['schedule']['start']);
        // For each meeting in the database
        if(!empty(Meeting::with('schedule')->get())){
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
                    return "Error: Meeting Conflict Detected with meeting: ".$i->title.", when creating this meeting.";
                }
            }
        }
    }

    public function schedule(){
        return $this->hasOne(Schedule::class, 'meetId', 'id');
    }

    public static function validationRules(){
        return [
            'title' => 'required|string',
            'schedule.isRepeat' => 'required|boolean',
            'schedule.start' => 'required|date|after_or_equal:tomorrow',
            'schedule.duration' => 'required|numeric|min:1',
            'schedule.repDays' => 'nullable|numeric'
            // 'start' => 'required|date|after_or_equal:tomorrow',
            // 'duration' => 'required|integer|numeric|min:1|max:9|between:1.0,9.0'
        ];
    }

    public static function validationMessages(){
        return [
            'title.required' => 'Please name this Scheduled Meeting',
            'schedule.start.required' => 'Please provide a starting date and time',
            'schedule.start.date'     => 'Please provide a date and time',
        ];
    }

}

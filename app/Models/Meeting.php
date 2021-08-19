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
     * Any Conflict Checker
     *  This houses the overall logic to identify which conflict method to run
     * 
     * @param Array Incoming Validated Meeting  
     * @return String Either NULL or an String Error Message
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
     * @param Array Incoming Validated Meeting  
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
                    for($j = 0; $j < (365/$variable['schedule']['repDays']); $j++){ // Conflict by the next year (365/repdays)
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
     * 
     * @param Array Incoming Validated Meeting  
     */
    private static function singleConflict($variable){
        $meetDate = Carbon::parse($variable['schedule']['start']);
        // For each meeting in the database
        if(!empty(Meeting::with('schedule')->get())){
            // // Convert Duration to Seconds to add (incoming)
            $str_time = $variable['schedule']['duration'];
            sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
            $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
            foreach(Meeting::with('schedule')->get() as $i){
                $carbonDate=Carbon::parse($i->schedule->start);
                // Convert Duration to Seconds to add (inList)
                $str_time2 = $i->schedule->duration;
                sscanf($str_time2, "%d:%d:%d", $hours2, $minutes2, $seconds2);
                $time_seconds2 = isset($seconds2) ? $hours2 * 3600 + $minutes2 * 60 + $seconds2 : $hours2 * 60 + $minutes2;
                // If the current meeting's start date time and end time is between the intended variable start date time and duration
                $checker = $meetDate->between($carbonDate,Carbon::parse($i->schedule->start)->addSeconds($time_seconds2));
                $checker2 = $carbonDate->between($meetDate,Carbon::parse($variable['schedule']['start'])->addSeconds($time_seconds));
                if($checker||$checker2){
                    // Declare a Meeting Conflict
                    return "Error: Meeting Conflict Detected with meeting: ".$i->title.", when creating this meeting.";
                }
            }
        }
    }

    /**
     * Relation to Schedule
     * @return Schedule Related Meeting Schedule 
     */
    public function schedule(){
        return $this->hasOne(Schedule::class, 'meetId', 'id');
    }

    /**
     * Validation Rules
     */
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

    /**
     * Validation Messages
     */
    public static function validationMessages(){
        return [
            'title.required' => 'Please name this Scheduled Meeting',
            'schedule.start.required' => 'Please provide a starting date and time',
            'schedule.start.date'     => 'Please provide a date and time',
        ];
    }

}

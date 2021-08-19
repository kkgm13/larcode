<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Schedule Model
 *  This indicates a meeting's schedule with capability to have multiple meetings 
 */
class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'meetId',
        'isRepeat',
        'start',
        'duration',
        'repDays', // Small issue in terms of agreemnt: the intended understanding 
    ];

    /**
     * Relationship
     *  Get Associated Meeting
     */
    public function meeting(){
        return $this->belongsTo(Meeting::class, 'id' , 'meetId');
    }
}

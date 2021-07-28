<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'meetId',
        'isRepeat',
        'start',
        'duration',
        'repDays',
    ];

    public function meeting(){
        return $this->belongsTo(Meeting::class, 'id' , 'meetId');
    }
}

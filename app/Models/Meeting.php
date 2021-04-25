<?php

namespace App\Models;

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

    public static function validationRules(){
        return [
            'title' => 'required|string',
            'start' => 'required|date|after_or_equal:tomorrow|unique',
        ];
    }

    public static function validationMessages(){
        return [
            'title.required' => 'Please name this Scheduled Meeting',
            'start.required' => 'Please provide a starting date and time',
            'start.date'     => 'Please provide a date and time',
            'start.after_or_equal' => 'Please select a meeting date after :date',
            'start.unique'   => 'Please reschdule this meeting due to meeting conflict',
        ];
    }

}

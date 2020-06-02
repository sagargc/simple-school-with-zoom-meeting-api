<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'subject_id',
        'student_id',
        'name', 
        'detail',
        'start',
        'end',
        'document',
        'status'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id',
        'name', 
        'dob',
        'gender',
        'photo',
        'email', 
        'phone_no', 
        'specialization',
        'address',
        'status'
    ];
}

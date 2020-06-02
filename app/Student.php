<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
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
        'address',
        'status'
    ];
}

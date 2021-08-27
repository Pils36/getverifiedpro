<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    //Enable Mass Assignment
    protected $fillable = ['execid', 'firstname', 'lastname', 'password', 'profession', 'city', 'industry', 'country', 'email'];
}

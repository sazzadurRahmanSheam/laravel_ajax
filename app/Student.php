<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $table = 'students';
    protected $fillable = [
        'firstName', 'lastName','course','section',
    ];
}

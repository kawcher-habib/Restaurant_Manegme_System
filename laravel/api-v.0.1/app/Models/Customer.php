<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'emp_id',
        'name',
        'email',
        'phone',
        'address',
        'designation',
        'branch',
        'salary',
        'join_date',
    ];
}

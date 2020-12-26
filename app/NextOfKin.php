<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    protected $fillable = ['first_name', 'last_name', 'other_names', 'id_number', 'dob', 'residence', 'work_place', 'phone'];

}

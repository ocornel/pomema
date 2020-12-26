<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['pc_number', 'first_name', 'last_name', 'other_names', 'sex', 'dob', 'residence', 'phone', 'created_by'];

    const GENDERS = [
        self::SEX_MALE => "Male",
        self::SEX_FEMALE => "Female",
        self::SEX_OTHER => "Other"
    ];

    const SEX_MALE = 'M';
    const SEX_FEMALE = 'F';
    const SEX_OTHER = 'O';

}

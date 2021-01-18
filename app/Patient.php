<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = ['pc_number', 'first_name', 'last_name', 'other_names', 'sex', 'dob', 'residence', 'phone', 'created_by', 'cleared_by'];

    const GENDERS = [
        self::SEX_MALE => "Male",
        self::SEX_FEMALE => "Female",
        self::SEX_OTHER => "Other"
    ];

    const SEX_VALUES = [
        self::SEX_MALE,
        self::SEX_FEMALE,
        self::SEX_OTHER
    ];

    const SEX_MALE = 'M';
    const SEX_FEMALE = 'F';
    const SEX_OTHER = 'O';

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->other_names . ' ' . $this->last_name;
    }

    public function getAgeAttribute() {
        return Carbon::parse($this->dob)->diff(Carbon::now())->format('%yY %mM %dD');

    }

}

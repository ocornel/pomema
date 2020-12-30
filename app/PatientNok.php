<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientNok extends Model
{
    protected $fillable = ['patient_id', 'nok_id', 'created_by', 'is_primary'];

}

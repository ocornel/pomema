<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    protected $fillable = ['first_name', 'last_name', 'other_names', 'id_number', 'dob', 'residence', 'work_place', 'phone', 'created_by'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->other_names . ' ' . $this->last_name;
    }

    public function getAgeAttribute() {
        return Carbon::parse($this->dob)->diff(Carbon::now())->format('%yY');
    }

    public function getPatientsAttribute() {
//        dd(PatientNok::where('nok_id', $this->id)->pluck('patient_id'));
        return Patient::whereIn('id', PatientNok::where('nok_id', $this->id)->pluck('patient_id'))->get();
    }

    public function getPatientsCountAttribute() {
        return count($this->getPatientsAttribute());
    }
}

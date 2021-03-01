<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class Patient extends BaseModel
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

    public function getYearsAttribute() {
        return intval(Carbon::parse($this->dob)->diff(Carbon::now())->format("%y"));
    }

    public function getNoksAttribute() {
//        return Patient::whereIn('id', PatientNok::where('nok_id', $this->id)->pluck('patient_id'))->get();
        return NextOfKin::whereIn('id', PatientNok::where('patient_id', $this->id)->pluck('nok_id'))->get();
    }

    public function getPrimaryNokAttribute() {
        return NextOfKin::whereIn('id',
            PatientNok::where('patient_id', $this->id)->where('is_primary', true)
                ->pluck('nok_id'))->first();
    }

    public function getPNokIdAttribute() {
        if($pnok = $this->primary_nok) {
            return $pnok->id_number;
        }
    }

    public function getCreditsAttribute() {
        return Credit::wherePatientId($this->id)->orderBy('due_date', 'asc')->get();
    }

    public function getCreditDueAttribute() {
        return Credit::wherePatientId($this->id)->whereCleared(0)->sum('amount_due');
    }

    public function getCreditClearedAttribute() {
        return Credit::wherePatientId($this->id)->whereCleared(1)->sum('amount_due');
    }

    public function getCreditTotalAttribute() {
        return Credit::wherePatientId($this->id)->sum('amount_due');
    }

    public function getGenderAttribute() {
        return self::GENDERS[$this->sex];
    }

    public function getUidAttribute() {
        return $this->pc_number;
    }

    public function getNextDueCreditAttribute() {
        return Credit::wherePatientId($this->id)->whereCleared(0)->orderBy('due_date', 'asc')->first();
    }

}

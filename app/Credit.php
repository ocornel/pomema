<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $fillable = ['patient_id', 'due_date', 'amount_due', 'cleared', 'created_by', 'cleared_on', 'cleared_by'];

    public function getCodeAttribute() {
        $pid = str_pad($this->patient_id, 3, '0', STR_PAD_LEFT);
        $cid = str_pad($this->id, 3, '0', STR_PAD_LEFT);
        return 'C'.$cid.'P'.$pid;
    }

    public function getPatientAttribute() {
        return Patient::find($this->patient_id);
    }

    public function getStatusTextAttribute() {
        if ($this->cleared) return "Cleared";
        return "Pending";
    }

}

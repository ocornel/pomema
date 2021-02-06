<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $fillable = ['patient_id', 'due_date', 'amount_due', 'cleared', 'created_by', 'cleared_on', 'cleared_by'];

    const STATUS_PENDING = "Pending";
    const STATUS_CLEARED = "Cleared";
    const STATUS_OVERFLOW = "Overflow";

    public function getCodeAttribute() {
        $pid = str_pad($this->patient_id, 3, '0', STR_PAD_LEFT);
        $cid = str_pad($this->id, 3, '0', STR_PAD_LEFT);
        return 'C'.$cid.'P'.$pid;
    }

    public function getPatientAttribute() {
        return Patient::find($this->patient_id);
    }

    public function getStatusTextAttribute() {
        if ($this->cleared) return self::STATUS_CLEARED;
        if ($this->amount_due < 0) return self::STATUS_OVERFLOW;
        return self::STATUS_PENDING;
    }

    public function clear($amount_paid) {
        $owed = $this->amount_due;
        $user_id = Auth()->user()->id;
        if ($owed == $amount_paid) {
            // clear and move on
            $this->update([
                'cleared'=>true,
                'cleared_by' =>$user_id,
                'cleared_on'=>now()
            ]);
            return [
                'result'=>'cleared',
                'overflow'=>0
            ];
        }
        elseif($owed > $amount_paid) {
            // reduce, create new credit
            $this->update([
                'cleared'=>true,
                'amount_due'=>$amount_paid,
                'cleared_by' =>Auth()->user()->id,
                'cleared_on'=>now()
            ]);
            $balance = $owed - $amount_paid;
            Credit::create([
                'patient_id'=>$this->patient_id,
                'due_date'=>now(),
                'amount_due'=>$balance,
                'created_by'=>$user_id
            ]);
            return [
                'result'=>'underpaid',
                'overflow'=>0
            ];
        }
        else {
            // clear, go to next
            $this->update([
                'cleared'=>true,
                'cleared_by' =>Auth()->user()->id,
                'cleared_on'=>now()
            ]);
            $overflow = $amount_paid - $owed;
            $patient = $this->patient;
            $next_due = $patient->next_due_credit;
            if ($next_due) {
                return $next_due->clear($overflow);
            }
            // create overflow
            Credit::create([
                'patient_id'=>$this->patient_id,
                'due_date'=>date('Y-m-d', strtotime("7 days")),
                'amount_due'=>$overflow * -1,
                'created_by'=>$user_id,
                'cleared_on'=>null
            ]);
            return [
                'result'=>'overpaid',
                'overflow'=>$overflow
            ];

        }
    }

}

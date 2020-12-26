<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $fillable = ['patient_id', 'due_date', 'amount_due', 'cleared', 'created_by'];

}

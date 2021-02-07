<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{
    const SUPER_ADMIN_ID = 1;
    public static function safe_divide($numerator, $denominator, $decimals=2){
        if ($numerator == 0 or $denominator == 0){
            return round(0,$decimals);
        }
        return round($numerator/$denominator,$decimals);
    }
}

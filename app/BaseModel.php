<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getCreatorAttribute() {
        return User::find($this->created_by);
    }
}

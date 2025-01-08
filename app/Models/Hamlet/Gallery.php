<?php

namespace App\Models\Hamlet;

use App\Models\Hamlet;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function hamlet(){
        return $this->hasOne(Hamlet::class, 'hamlet_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HamletNumber extends Model
{
    protected $table = 'hamlet_numbers';
    protected $primarykey = 'id';
    protected $fillable = [
        'street',
        'number',
        'rt',
        'rw',
        'village'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'upload_at' => 'datetime'
    ];
}

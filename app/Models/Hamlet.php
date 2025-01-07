<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hamlet extends Model
{
    protected $table = 'hamlet';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'title',
        'image',
        'rt',

    ];
    protected $casts = [
        'created_at' => 'datetime',
        'upload_at' => 'datetime'
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $table = 'submissions';
    protected $primarykey = 'id';
    protected $fillable = [
        'nik_id',
        'title',
        'date',
        'hamlet_id',
        'status',
        'requisite'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

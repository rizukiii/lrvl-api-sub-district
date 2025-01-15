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

    public function user()
    {
        return $this->belongsTo(User::class, 'nik_id', 'id'); // Kolom `nik_id` di Submission menghubungkan dengan `nik` di User
    }


    public function hamlet(){
        return $this->belongsTo(Hamlet::class,'hamlet_id','id');
    }
}

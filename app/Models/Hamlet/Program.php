<?php

namespace App\Models\Hamlet;

use App\Models\Hamlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = 'programs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'hamlet_id',
        'rt',
        'work',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function hamlet(){
        return $this->belongsTo(Hamlet::class,'hamlet_id');
    }
}

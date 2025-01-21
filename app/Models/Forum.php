<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'forums';
    protected $primarykey = 'id';
    protected $fillable = [
        'image',
        'user_id',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}

<?php

namespace App\Models\User;

use App\Models\Hamlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
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

    public function hamlet(){
        return $this->hasMany(Hamlet::class);
    }
}

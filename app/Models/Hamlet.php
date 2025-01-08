<?php

namespace App\Models;

use App\Models\Hamlet\Gallery;
use Illuminate\Database\Eloquent\Model;

class Hamlet extends Model
{
    protected $table = 'hamlets';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'image',
        'title',
        'rt',

    ];
    protected $casts = [
        'created_at' => 'datetime',
        'upload_at' => 'datetime'
    ];
    public function hamlet_galleries(){
        return $this->hasOne(Gallery::class);
    }
}

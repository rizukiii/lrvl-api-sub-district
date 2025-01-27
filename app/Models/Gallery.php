<?php

namespace App\Models;

use App\Models\Gallery\Detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    protected $primarykey = 'id';
    protected $fillable = [
        'image',
        'title',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function images(){
        return $this->hasMany(Detail::class,'gallery_id','id');
    }
}

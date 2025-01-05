<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryDetail extends Model
{
    use HasFactory;
    protected $table = 'gallery_details';
    protected $PrimaryKey = 'id';
    protected $fillable = [
        'image',
        'gallery_id',
    ];

    protected function casts(){
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }

    public function gallery(){
        return $this->belongsTo(Gallery::class,'gallery_id','id');
    }
}

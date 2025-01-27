<?php

namespace App\Models\Gallery;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'albums';
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

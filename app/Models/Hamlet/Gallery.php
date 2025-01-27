<?php

namespace App\Models\Hamlet;

use App\Models\Hamlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'halbums';
    protected $primaryKey = 'id';
    protected $fillable = [
        'hamlet_detail_id',
        'image'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function hamletDetail()
    {
        return $this->belongsTo(Hamlet::class, 'hamlet_detail_id');  // Correct foreign key
    }
}

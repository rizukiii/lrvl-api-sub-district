<?php

namespace App\Models;

use App\Models\Hamlet\Gallery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HamletDetail extends Model
{
    use HasFactory;
    protected $table = 'hamlet_details';
    protected $primarykey = 'hamlet_id';
    protected $fillable = [
        'hamlets_id',
        'maps'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'hamlet_detail_id');  // Ensure correct foreign key name
    }

    public function hamlets()
    {
        return $this->belongsTo(Hamlet::class, 'hamlets_id');  // Ensure correct foreign key name
    }
}

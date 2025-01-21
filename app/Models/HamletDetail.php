<?php

namespace App\Models;

use App\Models\Hamlet\Gallery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HamletDetail extends Model
{
    use HasFactory;
    protected $table = 'hamlet_details';
    protected $primaryKey = 'id'; // Corrected: should be `hamlet_id` as the primary key
    protected $fillable = [
        'hamlets_id',  // Corrected to match the foreign key column name
        'latitude',
        'longitude'

    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'hamlet_detail_id');  // Ensure correct foreign key name
    }

    public function hamlet()
    {
        return $this->belongsTo(Hamlet::class, 'hamlets_id'); // Foreign key harus benar
    }
}

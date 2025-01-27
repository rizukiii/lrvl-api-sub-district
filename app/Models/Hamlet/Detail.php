<?php

namespace App\Models\Hamlet;

use App\Models\Hamlet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'hdetails';
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

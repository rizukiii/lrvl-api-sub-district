<?php


namespace App\Models;

use App\Models\Hamlet\Gallery;
use Illuminate\Database\Eloquent\Model;

class Hamlet extends Model
{
    protected $table = 'hamlets';
    protected $primaryKey = 'id'; // Corrected: should be `primaryKey` instead of `primarykey`
    protected $fillable = [
        'name',
        'image',
        'title',
        'rt',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'upload_at' => 'datetime',
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'hamlet_detail_id');  // Ensure correct foreign key name
    }

    public function details()
    {
        return $this->hasMany(HamletDetail::class, 'hamlets_id');
    }
}

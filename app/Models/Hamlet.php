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

    public function hamlet_details()
    {
        return $this->hasMany(HamletDetail::class, 'hamlet_id');  // Make sure the foreign key is `hamlet_id`
    }

    public function hamlet_galleries()
    {
        return $this->hasMany(Gallery::class, 'hamlet_detail_id', 'id');
    }
}

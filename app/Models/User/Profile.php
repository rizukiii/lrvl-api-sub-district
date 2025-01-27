<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $primarykey = 'id';
    protected $fillable = [
        'user_id',
        'image',
        'fullname',
        'age',
        'gender'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'upload_at' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}

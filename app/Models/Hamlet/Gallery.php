<?php

namespace App\Models\Hamlet;

use App\Models\Hamlet;
use App\Models\HamletDetail;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'hamlet_galleries';
    protected $primarykey = 'id';
    protected $fillable = [
        'hamlet_detail_id',
        'image'

    ];
    public function hamletDetail()
{
    return $this->belongsTo(HamletDetail::class, 'hamlet_detail_id');  // Use correct foreign key
}

}

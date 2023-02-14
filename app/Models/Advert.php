<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advert extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'placement_type',
        'address',
        'description',
        'payment',
        'square'
    ];

    // relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, "mediaable");
    }
}

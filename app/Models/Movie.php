<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'genre',
        'publish_day',
        'image',
        'user_id'
    ];

    public function users() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

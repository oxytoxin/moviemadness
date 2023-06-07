<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchlistItem extends Model
{
    use HasFactory;

    const BOOKMARKED = 1;
    const CURRENTLY_WATCHING = 2;
    const COMPLETED = 3;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'other_details' => 'array',
        'watched_at' => 'immutable_datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

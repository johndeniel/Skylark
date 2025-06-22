<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'bookmarks';

    protected $fillable = [
        'userid',
        'thought_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['bookmark_count'];

    /**
     * Get the user who bookmarked
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

    /**
     * Get the bookmarked thought
     */
    public function thought()
    {
        return $this->belongsTo(Thought::class, 'thought_id', '_id');
    }

    /**
     * Get the bookmark count for this thought
     */
    public function getBookmarkCountAttribute()
    {
        return static::where('thought_id', $this->thought_id)->count();
    }

    /**
     * Scope to get bookmark counts for multiple thoughts efficiently
     */
    public function scopeWithBookmarkCounts($query, $thoughtIds = null)
    {
        if ($thoughtIds) {
            return $query->whereIn('thought_id', $thoughtIds);
        }
        return $query;
    }
}
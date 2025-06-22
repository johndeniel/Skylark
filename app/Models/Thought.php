<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Thought extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'thoughts';

    protected $fillable = [
        'userid',
        'content',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who posted this thought
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

    /**
     * Get bookmarks for this thought
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'thought_id', '_id');
    }

    /**
     * Get users who bookmarked this thought
     */
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, null, 'thought_id', 'userid', '_id', 'userid', 'bookmarks');
    }

    /**
     * Get human readable time
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get bookmark count
     */
    public function getBookmarkCountAttribute(): int
    {
        return $this->bookmarks()->count();
    }

    /**
     * Check if current user has bookmarked this thought
     */
    public function getIsBookmarkedAttribute(): bool
    {
        if (!auth()->check()) {
            return false;
        }
        
        return $this->bookmarks()->where('userid', auth()->user()->userid)->exists();
    }
}
<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as AuthenticatableUser;

class User extends AuthenticatableUser
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'userid';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'userid',
        'name',
        'username',
        'pronoun',
        'password',
        'bio',
        'photo_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getPhotoUrlAttribute($value): ?string
    {
        return $value;
    }

    public function getAuthIdentifierName(): string
    {
        return 'userid'; 
    }

    public function getAuthIdentifier(): mixed
    {
        return $this->userid; 
    }

    /**
     * Get user's thoughts
     */
    public function thoughts()
    {
        return $this->hasMany(Thought::class, 'userid', 'userid');
    }

    /**
     * Get user's bookmarks
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'userid', 'userid');
    }

    /**
     * Get bookmarked thoughts
     */
    public function bookmarkedThoughts()
    {
        return $this->belongsToMany(Thought::class, null, 'userid', 'thought_id', 'userid', '_id', 'bookmarks');
    }

    /**
     * Check if user has bookmarked a thought
     */
    public function hasBookmarked($thoughtId): bool
    {
        return $this->bookmarks()->where('thought_id', $thoughtId)->exists();
    }
}
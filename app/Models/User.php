<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Auth\User as AuthenticatableUser;

class User extends AuthenticatableUser
{
    use HasFactory, Notifiable;
    
    // Use the default connection for MongoDB
    protected $connection = 'mongodb';
    
    // The primary key is '_id' by default in MongoDB models, 
    // but we use 'userid' as our unique identifier for relationships.
    protected $primaryKey = '_id'; 
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userid',
        'name',
        'username',
        'pronoun',
        'password',
        'bio',
        'photo_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Accessor for photo_url. Returns the value as is.
     * No changes needed here, but it's good practice to have it.
     */
    public function getPhotoUrlAttribute($value): ?string
    {
        return $value;
    }

    /**
     * Overrides the default method to use 'userid' as the unique identifier for auth.
     */
    public function getAuthIdentifierName(): string
    {
        return 'userid';
    }

    /**
     * Overrides the default method to return the value of 'userid'.
     */
    public function getAuthIdentifier(): mixed
    {
        return $this->userid;
    }

    /**
     * Get user's thoughts.
     * The local key is 'userid' on the User model.
     * The foreign key is 'userid' on the Thought model.
     */
    public function thoughts()
    {
        return $this->hasMany(Thought::class, 'userid', 'userid');
    }

    /**
     * Get user's bookmarks.
     * The local key is 'userid' on the User model.
     * The foreign key is 'userid' on the Bookmark model.
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'userid', 'userid');
    }

    /**
     * Check if user has bookmarked a thought.
     */
    public function hasBookmarked($thoughtId): bool
    {
        // '_id' is assumed to be the primary key of the Thought model.
        return $this->bookmarks()->where('thought_id', $thoughtId)->exists();
    }
}
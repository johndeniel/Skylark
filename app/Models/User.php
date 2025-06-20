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
}
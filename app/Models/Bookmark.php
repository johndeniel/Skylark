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
}
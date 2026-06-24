<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'isbn', 'category', 'image', 'description', 'rating', 'reviews'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_favorite', 'progress_percentage', 'last_read_at')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

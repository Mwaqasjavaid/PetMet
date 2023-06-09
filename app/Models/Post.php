<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}

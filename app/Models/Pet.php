<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    use HasFactory;
    public $table = "pets";
    protected $fillable = [
        'petname',
        'category',
        'age',
        'image',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','body', 'typePostId	'
    ];

    protected $table='post';

    public function user(){
        return $this->hasOne(User::class);
    }

    public function category(){
        return $this->hasOne(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}

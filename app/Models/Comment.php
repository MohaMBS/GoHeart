<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'userId',
        'postId',
        'comment'
    ];

    
    public function user(){
        return $this->hasOne(User::class);
    }

    public function post(){
        return $this->hasOne(Post::class);
    }
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Comment;
use App\Models\FavoritePost;
use App\Models\SavePost;

class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'title','body', '	typepost_id 	','creator_name','security_token'
    ];

    protected $table='post';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->hasOne(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function favorite(){
        return $this->hasMany(FavoritePost::class);
    }

    public function savePost()
    {
        return $this->hasMany(SavePost::class);
    }
}

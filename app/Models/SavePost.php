<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Post;

class SavePost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','post_id', 'onSave'
    ];

    protected $table='saves_posts';
    
    public function user(){
        return $this->hasMany(User::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}

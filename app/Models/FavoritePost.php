<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritePost extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'user_id','post_id', 'onFavorite'
    ];

    protected $table='favorites_posts';
    
    public function user(){
        return $this->hasMany(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}

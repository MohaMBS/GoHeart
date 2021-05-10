<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Post;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','post_id', 'user_reported_id','name_user','email_user','name_user_reported','email_user_reported'
    ];

    protected $table='reports';

    public function user(){
        return $this->hasMany(User::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
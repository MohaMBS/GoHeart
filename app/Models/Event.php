<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CommentsEvent;

class Event extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'name_user',
        'is_active',
        'dates',
        'title',
        'front_page',
        'cords',
        'body'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comment(){
        return $this->hasMany(CommentsEvent::class);
    }
}

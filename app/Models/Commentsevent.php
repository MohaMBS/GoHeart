<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CommentsEvent extends Model
{
    use HasFactory;

    protected $table ='commentsevents';
    
    protected $fillable=[
        'user_id',
        'event_id ',
        'user_name',
        'comment',
        'comment_deleted'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}

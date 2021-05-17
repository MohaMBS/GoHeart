<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Post;

class Report extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'user_id','post_id', 'user_reported_id','name_user','email_user','name_user_reported','email_user_reported'
    ];

    protected $table='reports';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function getApproveButtonHtml()
    {
        return '<a target="_blank-" style="color:#ff8c00;" href="'.route('seeOne',$this->post_id).'" class="btn btn-sm btn-link"><i class="la la-external-link"></i> Ver entrada</a>';
    }
}

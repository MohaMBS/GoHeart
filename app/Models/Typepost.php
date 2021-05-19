<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Typepost extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    
    protected $table='typeposts';

    protected $fillable = [
        'nameType'
    ];
    
    protected $guarded = ['id'];

    /*public function pot(){
        return $this->hasMany(Post::class);
    } */
    /*typepost_id */
}

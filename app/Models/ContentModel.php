<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentModel extends Model
{
    use HasFactory;
    protected $table = 'contents';
    protected $fillable = ['user_id', 'content', 'like', 'image'];
    protected $guarded = ['id'];

    public function comments(){
        return $this->hasMany(CommentModel::class, "content_id");
    }

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function liked(){
        return $this->belongsToMany(User::class,"likes", "content_id","user_id")->withTimestamps();
    }

    public function checkliked(){
        return $this->liked()->where("user_id",auth()->user()->id)->exists();
    }

    // public function countLike(){
    //     return $this->belongsTo(LikeModel::class,"content_id");

    // }
}

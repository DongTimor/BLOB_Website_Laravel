<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentModel extends Model
{
    use HasFactory;
    protected $table = "comment";
    protected $fillable = [
        "user_id", "content_id", "comment"
    ];
    protected $guarded = ["id"];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function content():BelongsTo
    {
        return $this->belongsTo(ContentModel::class, "content_id");
    }


}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LikeModel extends Model
{
    use HasFactory;

    protected $table = 'likes';

    // Đảm bảo rằng các cột timestamp được chuyển đổi sang múi giờ +7 khi truy xuất
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = ["content_id,user_id"];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Bangkok'); // Múi giờ +7
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Bangkok'); // Múi giờ +7
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->setTimezone('UTC');
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = Carbon::parse($value)->setTimezone('UTC');
    }

    public function content() : BelongsTo
    {
        return $this->belongsTo(ContentModel::class,"content_id");
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }



}

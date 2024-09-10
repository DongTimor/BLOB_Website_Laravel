<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowModel extends Model
{
    use HasFactory;
    protected $table = 'follows';

    // Đảm bảo rằng các cột timestamp được chuyển đổi sang múi giờ +7 khi truy xuất
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = ["follower_id,followee_id"];

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

    public function followable(): BelongsTo  
    {
        return $this->belongsTo(User::class,"follower_id");
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }



}

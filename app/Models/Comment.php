<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Carbon;
class Comment extends BaseModel
{
    protected $table = 'comments';

    protected $primaryKey = 'comment_id';

    protected $keyType = 'int';

    protected $fillable = [
        'comment_id',
        'post_id',
        'comment_content',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    // TODO Liên kết giữa comment và người dùng để lấy ra được tên người nào dã Comment bài viết đó.
    public function user()
    {
        return $this->hasOne(User::class,'user_id','user_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i:s');  // TODO:
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}

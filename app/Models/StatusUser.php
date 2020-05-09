<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class StatusUser extends BaseModel
{
    protected $table = 'status_users';

    protected $primaryKey = 'status_users_id';

    protected $keyType = 'int';

    protected $fillable = [
        'status_users_id',
        'status_id',
        'user_id',
        // 'status_users_reason',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class ClassUser extends BaseModel
{
    protected $table = 'class_users';

    protected $primaryKey = 'class_user_id';

    protected $keyType = 'int';

    protected $fillable = [
        'class_user_id',
        'user_id',
        'class_id',
        'class_user_accountability',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

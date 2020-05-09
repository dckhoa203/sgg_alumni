<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class GraduateUser extends BaseModel
{
    protected $table = 'graduate_users';

    protected $primaryKey = 'graduate_users_id';

    protected $keyType = 'int';

    protected $fillable = [
        'graduate_users_id',
        'register_graduate_id',
        'academy_id',
        'major_id',
        'major_branch_id',
        'class_id',
        'user_id',
        'graduate_users_type_of_tranning',
        'graduate_users_note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

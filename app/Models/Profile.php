<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Profile extends BaseModel
{
    protected $table = 'profiles';

    protected $primaryKey = 'profile_id';

    protected $keyType = 'int';

    protected $fillable = [
        'profile_id',
        'profile_structure_id',
        'user_id',
        'profile_values',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;
}

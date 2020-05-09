<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class ProfileStructure extends BaseModel
{
    protected $table = 'profile_structures';

    protected $primaryKey = 'profile_structure_id';

    protected $keyType = 'int';

    protected $fillable = [
        'profile_structure_id',
        'role_id',
        'profile_structure_name',
        'profile_structure_type',
        'profile_structure_default',
        'profile_structure_version',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

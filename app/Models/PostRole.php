<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostRole extends Model
{
    protected $table = 'post_roles';

    protected $primaryKey = 'post_roles_id';

    protected $keyType = 'int';

    protected $fillable = [
        'post_roles_id',
        'post_id',
        'role_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

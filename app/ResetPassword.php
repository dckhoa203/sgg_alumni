<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $table = 'reset_passwords';

    protected $primaryKey = 'reset_password_id';

    protected $keyType = 'int';

    protected $fillable = [
        'reset_password_id',
        'user_id',
        'password_token',
        'send_request_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class MailTemplate extends BaseModel
{
    protected $table = 'mail_templates';

    protected $primaryKey = 'mail_template_id';

    protected $keyType = 'int';

    protected $fillable = [
        'mail_template_id',
        'user_id',
        'subject',
        'body',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

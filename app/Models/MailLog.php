<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class MailLog extends BaseModel
{
    protected $table = 'mail_logs';

    protected $primaryKey = 'mail_log_id';

    protected $keyType = 'int';

    protected $fillable = [
        'mail_log_id',
        'mail_template_id',
        'register_graduate_id',
        'mail_log_send_datetime',
        'mail_log_to',
        'mail_log_subject',
        'mail_log_body',
        'mail_log_file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

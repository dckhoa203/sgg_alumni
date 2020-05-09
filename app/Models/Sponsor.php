<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Sponsor extends BaseModel

{
    protected $table = 'sponsors';

    protected $primaryKey = 'sponsor_id';

    protected $keyType = 'int';

    protected $fillable = [
        'sponsor_id',
        'sponsor_title',
        'sponsor_content',
        'sponsor_money',
        'sponsor_date',
        'sponsor_to',
        'user_id',
        'company_id',
        'academy_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

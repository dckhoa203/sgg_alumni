<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class PostView extends BaseModel
{
    protected $table = 'post_views';

    protected $primaryKey = 'post_view_id';

    protected $keyType = 'int';

    protected $fillable = [
        'post_view_id',
        'post_id',
        'user_id',
        'post_is_like',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function __construct()
    {
        $this->fillable_list = $this->fillable;
    }
}

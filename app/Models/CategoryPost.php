<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class CategoryPost extends BaseModel
{
    protected $table = 'categorys_posts';

    protected $primaryKey = 'category_post_id';

    protected $keyType = 'int';

    protected $fillable = [
        'category_post_id',
        'category_id',
        'post_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
}

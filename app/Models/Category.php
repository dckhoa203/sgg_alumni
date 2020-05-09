<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Category extends BaseModel
{
    protected $table = 'categories';

    protected $primaryKey = 'category_id';

    protected $keyType = 'int';

    protected $fillable = [
        'category_id',
        'category_name',
        'category_slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function categories_posts()
    {
        return $this->belongsToMany(Post::class,'categorys_posts','category_id','post_id');
    }
}

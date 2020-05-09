<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassUser;

class PostClass extends Model
{
    protected $table = 'post_classes';

    protected $primaryKey = 'post_classes_id';

    protected $keyType = 'int';

    protected $fillable = [
        'post_classes_id',
        'post_id',
        'class_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

}

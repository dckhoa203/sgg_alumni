<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use App\PostClass;
use CarBon;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends BaseModel
{
    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    protected $keyType = 'int';

    protected $fillable = [
        'post_id',
        'user_id',
        'role_id',
        'class_id',
        'category_id',
        'post_title',
        'post_content',
        'post_file',
        'post_slug',
        'post_status',
        'post_link',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;


    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'post_slug' => [
                'source' => 'post_title'
            ]
        ];
    }
    // TODO SET POST SLUG
    public function setTitleAttribute($value)
    {
        $this->attributes['post_title'] = $value;
        $this->attributes['post_slug'] = str_slug($value);
    }

    public function user()
    {
        return $this->hasOne(User::class,'user_id','user_id');
    }

    // TODO Liên kết giữa bài đăng và lớp học. 3 bảng: post_classes, posts, classes
    public function classes()
    {
        return $this->belongsToMany(Classes::class,'post_classes','post_id','class_id');
    }

    // TODO 1 bài posts có thể cho - có nhiều phân quyền xem-đăng
    public function roles()
    {
        return $this->belongsToMany(Role::class,'post_roles','post_id','role_id');
    }

    // TODO bài đăng trên lớp
    public function post_classes()
    {
        return $this->belongsToMany(Classes::class,'post_classes','post_id','class_id');
    }

    // TODO bài đăng theo thể loại
    public function posts_categories()
    {
        return $this->belongsToMany(Category::class,'categorys_posts','post_id','category_id');
    }
    // public function show_user_post()
    // {
    //     return $this->hasManyThrough(
    //         User::class,
    //         ClassUser::class,
    //         'user_id',
    //         'user_id',
    //         'post_id',
    //         'class_user_id',
    //     );
    // }

    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i:s');  // TODO:
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}

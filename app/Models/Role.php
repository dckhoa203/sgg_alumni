<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Role extends BaseModel
{
    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    protected $keyType = 'int';

    protected $fillable = [
        'role_id',
        'role_name',
        'role_level',
        'role_note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;
    /************************************************************************
    /************************************************************************
     * TODO: Liên kết phân quyền của người dùng: Admin, teacher, users
     * 3 bảng: users,roles,role_users
     ***********************************************************************/
    public function users()
    {
        return $this->belongsToMany('App\User','role_users','role_id','user_id');
    }

    // tao là 1 người dùng(User) có phân quền User thì t có thể đăng NHIỀU bài posts
    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_roles','role_id','post_id');
    }

    public function permissions()
    {
        return $this->belongsTo(Permission::class,'role_id');
    }
}

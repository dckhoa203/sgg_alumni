<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class User extends BaseModel
{
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'username',
        'code',
        'course',
        'name',
        'password',
        'nation',
        'tel',
        'email',
        'other_email',
        'gender',
        'birth',
        'address',
        'family_tel',
        'family_address',
        'status_id',
        'district_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function __construct()
    {
        $this->fillable_list = $this->fillable;
    }

    // public function base_update(Request $request)
    // {
    //     $filter_param = $request->only($this->$fillable);
    //     $this->update_conditions = [
    //         'user_id' => 1,
    //     ];
    //     return parent::base_update($this->request);
    // }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_users', 'user_id', 'class_id');
    }

    /************************************************************************
    // TODO: trạng thái của người dùng : ĐI hc , đi làm , nghỉ học
    // 3 bảng: users, statuses, pivot_table status_users
    *************************************************************************/
    public function statuses()
    {
        return $this->belongsToMany(Status::class, 'status_users', 'user_id', 'status_id');
    }

    // 2 bảng: statuses, users
    // status_id trong bảng users,
    // public function status_index()
    // {
    //     return $this->belongsTo(Status::Class,'user_id','status_id');
    // }

    // Điểm tốt nghiệp trong function Show
    public function graduates()
    {
        return $this->hasOne(RegisterGraduate::class, 'register_graduate_code');
    }

    // public function graduate_users()
    // {
    //     return $this->belongsToMany(GraduateUser::class,'graduate_users','user_id','user_id');
    // }

    // Bài post của 1 người post
    public function posts()
    {
        return $this->belongsTo(Post::class, 'user_id', 'user_id');      // FK,PK
    }

    /************************************************************************
    /************************************************************************
     * TODO: Liên kết phân quyền của người dùng: Admin, teacher, users
     * 3 bảng: users,roles,role_users
     ***********************************************************************/
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }

    // TODO liên kết giữa người dùng và comment để biết xem tên người nào đã comment trên bài viết đó.
    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'user_id', 'user_id');
    }

    public function post_classes()
    {
        // return $this->hasManyThrough(
        //     Post::class,
        //     ClassUser::class,
        //     'user_id',      // FK on class_users table
        //     'class_id',     // FK on post_classes table
        //     'user_id',      // LK on users table
        //     'class_user_id',    // LK on class_users table
        // );
        return $this->belongsToMany(Post::class, 'post_classes', 'user_id', 'post_id');
    }

    public function work_users()
    {
        return $this->belongsToMany(Work::class, 'work_users', 'user_id', 'work_id');
    }

    public function hasRole($role)
    {
        $roles = $this->roles()->where('role_name', $role)->count();

        if ($roles == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function district()
    {
        return $this->hasOne(District::class, 'district_id', 'district_id');      // FK, PK cua bang users, districts
    }
}

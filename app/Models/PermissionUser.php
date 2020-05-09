<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class PermissionUser extends BaseModel
{
    protected $table = 'permission_users';

    protected $primaryKey = 'permission_user_id';

    protected $keyType = 'int';

    protected $fillable = [
        'permission_user_id',
        'route_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function route()
    {
        return $this->hasMany(Route::class,'route_id','route_id');
    }

    public function user()
    {
        return $this->hasMany(User::class,'user_id','user_id');
    }

    public static function checkedRoute($user_id,$route)
    {
        $checkedLog = self::where('user_id',$user_id)
            ->where('route_id',$route)
            ->first();
        return $checkedLog;
    }
}

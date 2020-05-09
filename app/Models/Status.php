<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Status extends BaseModel
{
    protected $table = 'statuses';

    protected $primaryKey = 'status_id';

    protected $keyType = 'int';

    protected $fillable = [
        'status_id',
        'status_name',
        'status_note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany(User::class,'status_users','status_id','user_id')->withPivot('status_users_reason');
    }

}

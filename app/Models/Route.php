<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class Route extends BaseModel
{
    protected $table = 'routes';

    protected $primaryKey = 'route_id';

    protected $keyType = 'int';

    protected $fillable = [
        'route_id',
        'route_link',
        'route_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function permissions()
    {
        return $this->belongsTo(Permission::class,'route_id');
    }
}

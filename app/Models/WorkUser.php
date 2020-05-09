<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Http\Request;

class WorkUser extends BaseModel
{
    protected $table = 'work_users';

    protected $primaryKey = 'work_user_id';

    protected $keyType = 'int';

    protected $fillable = [
        'work_user_id',
        'work_id',
        'user_id',
        'work_user_salary',
        'work_user_begin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->fillable_list = $this->fillable;         // trường fillable sẽ truyền vào biến fillable_list
    }

    public function base_update(Request $request)
    {
        // $filter_param = $request->only($this->$fillable);
        $this->update_conditions = [
            'work_user_id' => 1
        ];
        return parent::base_update($this->request);
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function work() {
        return $this->belongsTo('App\Models\Work', 'work_id', 'work_id');
    }
}

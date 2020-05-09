<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Http\Request;

class Ward extends BaseModel
{
    protected $table = 'wards';

    protected $primaryKey = 'ward_id';

    protected $keyType = 'int';

    protected $fillable = [
        'ward_id',
        'district_id',
        'ward_name',
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
        $filter_param = $request->only($this->fillable);
        $this->update_conditions = [
            'ward_id' => 1
        ];
        return parent::base_update($this->request);
    }

    // relationship model District
    public function district() {
        return $this->belongsTo('App\Models\District', 'district_id', 'district_id');
    }
    
    // relationship model User
    public function user() {
        return $this->haMany('App\Models\User', 'user_id', 'user_id');
    }

    // relationship model Company
    public function company() {
        return $this->hasMany('App\Models\Company', 'company_id', 'company_id');
    }
}

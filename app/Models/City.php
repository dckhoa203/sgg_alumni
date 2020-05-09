<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $primaryKey = 'city_id';

    protected $keyType = 'int';

    protected $fillable = [
        'city_id',
        'city_code',
        'city_name',
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
            'city_id' => 1
        ];
        return parent::base_update($this->request);
    }

    // relationship model District
    public function district() {
        return $this->hasMany('App\Models\District', 'city_id', 'city_id');
    }

    // relationship model Ward
    public function ward() {
        return $this->hasManyThrough('App\Models\Ward', 'App\Models\District', 'district_id', 'ward_id', 'city_id');
    }
}

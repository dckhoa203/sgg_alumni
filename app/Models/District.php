<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $primaryKey = 'district_id';

    protected $keyType = 'int';

    protected $fillable = [
        'district_id',
        'city_code',
        'district_code',
        'district_name',
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
            'district_id' => 1
        ];
        return parent::base_update($this->request);
    }

    // relationship model City
    public function city() {
        return $this->belongsTo('App\Models\City', 'city_id', 'city_id');
    }

    // relationship model Ward
    public function ward() {
        return $this->hasMany('App\Models\Ward', 'district_id', 'district_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'district_id','district_id');
    }
}

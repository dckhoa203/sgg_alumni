<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Http\Request;

class Company extends BaseModel
{
    protected $table = 'companies';

    protected $primaryKey = 'company_id';

    protected $keyType = 'int';

    protected $fillable = [
        'company_id',
        'ward_id',
        'company_name',
        'company_address',
        //'company_title',
        'company_email',
        'company_tel',
        'company_website',
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
            'company_id' => 1
        ];
        return parent::base_update($this->request);
    }

    // relationship model Ward
    public function ward() {
        return $this->belongsTo('App\Models\Ward', 'ward_id', 'ward_id');
    }

    // relationship model work
    public function work() {
        return $this->hasMany('App\Models\Work', 'work_id', 'work_id');
    }

    public function company_works()
    {
        return $this->belongsToMany(Work::class,'work_companies','company_id','work_id');
    }
}

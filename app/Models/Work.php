<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Http\Request;

class Work extends BaseModel
{
    protected $table = 'works';

    protected $primaryKey = 'work_id';

    protected $keyType = 'int';

    protected $fillable = [
        'work_id',
        'work_name',
        'work_position',
        'work_salary',
        'work_begin',
        'work_specialize',
        'work_end',
        'work_note',
        'work_status',
        'company_id',
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
            'work_id' => 1,
        ];

        return parent::base_update($this->request);
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'company_id');
    }

    public function work_users()
    {
        return $this->belongsToMany(User::class, 'work_users', 'work_id', 'user_id');
    }

    public function work_companies()
    {
        return $this->belongsToMany(Company::class, 'work_companies', 'work_id', 'company_id');
    }
}

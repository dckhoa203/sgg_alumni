<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Base\BaseModel;

class MajorBranch extends BaseModel
{
    protected $table = 'major_branchs';

    protected $primaryKey = 'major_branch_id';

    protected $keyType = 'int';

    protected $fillable = [
        'major_branch_id',
        'major_id',
        'major_branch_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function __construct()
    {
        $this->fillable_list = $this->fillable;         // trường fillable sẽ truyền vào biến fillable_list
    }

    public function base_update(Request $request)
    {
        // $filter_param = $request->only($this->$fillable);
        $this->update_conditions = [
            'major_branch_id' => 1,
        ];

        return parent::base_update($this->request);
    }

    public function class()
    {
        return $this->hasMany(Classes::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Base\BaseModel;

class Education extends BaseModel
{
    protected $table = 'educations';

    protected $primaryKey = 'education_id';

    protected $keyType = 'int';

    protected $fillable = [
        'education_id',
        'education_training_time',
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
            'education_id' => 1,
        ];

        return parent::base_update($this->request);
    }
}

<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Base\BaseModel;

class Major extends BaseModel
{
    protected $table = 'majors';

    protected $primaryKey = 'major_id';

    protected $keyType = 'int';

    protected $fillable = [
        'major_id',
        'academy_id',
        'major_code',
        'major_name',
        'major_description',
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
            'major_id' => 1,
        ];

        return parent::base_update($this->request);
    }

    public function class()
    {
        return $this->hasMany(Classes::class);
    }

}

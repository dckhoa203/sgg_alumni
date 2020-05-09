<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Base\BaseModel;

class RoleSurvey extends BaseModel
{
    protected $table = 'role_surveys';

    protected $primaryKey = 'role_survey_id';

    protected $keyType = 'int';

    protected $fillable = [
        'role_survey_id',
        'role_id',
        'survey_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function __construct()
    {
        $this->fillable_list = $this->fillable;
    }

    public function base_update(request $request)
    {
        $this->update_conditions = [
            'role_survey_id' => 1,
        ];

        return parent::base_update($this->request);
    }
}

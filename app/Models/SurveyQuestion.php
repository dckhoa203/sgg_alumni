<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Base\BaseModel;

class SurveyQuestion extends BaseModel
{
    protected $table = 'survey_questions';

    protected $primaryKey = 'survey_question_id';

    protected $keyType = 'int';

    protected $fillable = [
        'survey_question_id',
        'survey_id',
        'question_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function __construct(){
        $this->fillable_list = $this->fillable;
    }

    public function base_update(request $request){
        $this->update_conditions = [
            'survey_question_id' => 1
        ];
        return parent::base_update($this->request); 
    }

}

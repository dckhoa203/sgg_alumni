<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Base\BaseModel;
use App\Models\Answer;
use App\Models\Survey;

class Question extends BaseModel
{
    protected $table = 'questions';

    protected $primaryKey = 'question_id';

    protected $keyType = 'int';

    protected $fillable = [
        'question_id',
        'survey_id',
        'question_title',
        'question_mandatory',
        'question_type',
        'question_option',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function __construct()
    {
    $this->fillable_list = $this->fillable;   
    }

    public function base_update(request $request){
        $this->update_conditions = [
            'question_id' =>1
        ];
        return parent::base_update($this->request);
    }
    public function surveys()
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }

}

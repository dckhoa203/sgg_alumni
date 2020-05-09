<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SurveyQuestion;


class Survey extends BaseModel
{
    protected $table = 'surveys';

    protected $primaryKey = 'survey_id';

    protected $keyType = 'int';

    protected $fillable = [
        'survey_id',
        'user_id',
        'survey_name',
        'survey_description',
        'survey_start',
        'survey_end',
        'survey_version',
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
            'survey_id' => 1,
        ];

        return parent::base_update($this->request);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class, 'survey_id', 'survey_id');
    }
    public function answers()
    {
        return $this->hasMany(Answer::class, 'survey_id', 'survey_id');
    }
}

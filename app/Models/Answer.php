<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Http\Request;
use App\Models\User;

class Answer extends BaseModel
{
    protected $table = 'answers';

    protected $primaryKey = 'answer_id';

    protected $keyType = 'int';

    protected $fillable = [
        'answer_id',
        'survey_id',
        'user_id',
        'answer_content',
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
            'answer_id' => 1,
        ];

        return parent::base_update($this->request);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function surveys()
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }

}

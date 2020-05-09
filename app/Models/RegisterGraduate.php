<?php

namespace App\Models;

use App\Models\Base\BaseModel;

class RegisterGraduate extends BaseModel
{
    protected $table = 'register_graduate';

    protected $primaryKey = 'register_graduate_id';

    protected $keyType = 'int';
    
    protected $fillable = [
        'register_graduate_id',
        'register_graduate_phase',
        'register_graduate_academy',
        'register_graduate_decision',
        'register_graduate_date',
        'register_graduate_code',
        'register_graduate_name',
        'register_graduate_birth',
        'register_graduate_gender',
        'register_graduate_place_of_birth',
        'register_graduate_class_code',
        'register_graduate_AUN',
        'register_graduate_major_name',
        'register_graduate_major_branch_name',
        'register_graduate_GPA',
        'register_graduate_DRL',
        'register_graduate_TCTL',
        'register_graduate_ranked',
        'register_graduate_note',
        'register_graduate_nation',
        'register_graduate_year_begin',
        'register_graduate_course',
        'register_graduate_degree',
        'register_graduate_type_of_tranning',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','register_graduate_id');
    }
}

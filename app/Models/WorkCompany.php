<?php

namespace App\Models;


use App\Models\Base\BaseModel;
use Illuminate\Http\Request;

class WorkCompany extends BaseModel
{
    protected $fillable = ['work_company_id','work_id','company_id'];
}

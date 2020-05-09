<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SurveysStatisticExport implements FromView
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
       $data = $this->data;
        
        return view('pages.admins.statistic.form_export_statistics_survey', compact('data'));
    }
}

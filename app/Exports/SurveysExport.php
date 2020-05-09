<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SurveysExport implements FromView
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function view(): View
    {
        $survey = $this->data;
        
        return view('pages.admins.answer.export', ['survey' => $survey]);
    }

}

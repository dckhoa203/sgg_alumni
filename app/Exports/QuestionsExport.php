<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\FromArray;

class QuestionsExport implements FromView
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // public function array(): array
    // {
    //     return $this->data;
    // }

    // public function headings(): array
    // {
    //     return [
    //         'Câu trả lời',
    //         'Tổng số',
    //         'Tỷ lệ',
    //     ];
    // }

    public function view(): View
    {
        return view('pages.admins.statistic.export', ['data' => $this->data]);
    }
}

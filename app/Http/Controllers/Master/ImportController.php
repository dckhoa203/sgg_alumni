<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegisterGraduate;
use DB;

class ImportController extends Controller
{

    public function index()
    {
        $phase = RegisterGraduate::groupby('register_graduate_date')->get();
        return view('pages.admins.imports.index',['phase' => $phase]);
    }
    public function import_students(Request $request)
    {
        return;
    }


    public function import_alumnies(Request $request)
    {
        return;
    }


    public function import_graduate(Request $request)
    {
        return;
    }
    public function show_file_import(Request $request, $phase, $year)
    {
        $show = RegisterGraduate::whereYear(
            'register_graduate_date','=',$year
            )
        ->where('register_graduate_phase','=',$phase)
        ->get();
        // dd($show);
        return view('pages.admins.imports.show_personal_file',['show'=> $show]);
    }
}

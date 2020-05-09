<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Classes;

class LopCoVanController extends Controller
{
    public function index()
    {
        $user_class = User::with('classes')
            ->join('class_users','users.user_id','class_users.user_id')
            ->join('classes','class_users.class_id','classes.class_id')
            ->join('majors','classes.major_id','=','majors.major_id')
            ->select('users.*','classes.*','majors.*')
            ->where('users.user_id',Auth::user()->user_id)
            ->selectRaw('YEAR(class_begin) as year')
            ->orderby('class_begin','desc')
            ->get();
        // dd($user_class);
        // $classID = User::with('classes')
        //     ->join('class_users','users.user_id','class_users.user_id')
        //     ->join('classes','class_users.class_id','classes.class_id')
        //     ->join('majors','classes.major_id','=','majors.major_id')
        //     ->where('users.user_id',Auth::user()->user_id)
        //     ->selectRaw('YEAR(class_begin) as year')
        //     ->orderby('class_begin','desc')
        //     ->get();
        // dd($classID);


        return view('pages.admins.advisers_class.index',['user_class' => $user_class]);
    }
}

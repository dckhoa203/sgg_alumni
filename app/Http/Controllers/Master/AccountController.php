<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
// use App\User;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Work;
use App\Models\Company;
use App\Models\District;
use App\Models\Role;
use App\Models\WorkUser;
use Illuminate\Support\Carbon;
use Hash;

class AccountController extends Controller
{
    public function index()
    {
        return view('pages.admins.accounts.profile');
    }

    // TODO HIỂN THỊ THÔNG TIN PROFILE
    public function profile(Request $request)
    {
        $works = DB::table('users')
        ->join('work_users','users.user_id','=','work_users.user_id')
        ->join('works','work_users.work_id','=','works.work_id')
        ->join('work_companies','works.work_id','=','work_companies.work_id')
        ->join('companies','work_companies.company_id','=','companies.company_id')
        ->select('works.*','companies.*')
        ->where('work_users.user_id','=',Auth::user()->user_id)
        ->get();

        $accounts = DB::table('users')->get();

        //dd($accounts);
        $infor_company =  Company::all();

        //dd($accounts);
        // $password = '';
        // foreach ($accounts as $account) {
        //     $password = Crypt::decrypt($account->password);
        // }
        // echo $password;
        return view('pages.admins.accounts.profile')
        ->with('accounts',$accounts)
        ->with('infor_company',$infor_company)
        ->with('accounts',$accounts);

    }


    // TODO PROFILE NEW 04/10/2019
    public function profile_new(Request $request)
    {
        $works = DB::table('users')
        ->join('work_users','users.user_id','=','work_users.user_id')
        ->join('works','work_users.work_id','=','works.work_id')
        ->join('work_companies','works.work_id','=','work_companies.work_id')
        ->join('companies','work_companies.company_id','=','companies.company_id')
        ->select('works.*','companies.*')
        ->where('work_users.user_id','=',Auth::user()->user_id)
        ->get();

        $accounts = User::with('classes','work_users','statuses','district')
            ->where('user_id',Auth::user()->user_id)    
            ->get();
        // dd($accounts);
        $majors = Classes::with(['users','major','major_branch'])
            ->whereHas('users',function($query){
                $query->where('users.user_id',Auth::user()->user_id);
            })
            ->get();
        // dd($majors);
        $roles = Role::with('users')->whereHas('users',function($query){
            $query->where('users.user_id',Auth::user()->user_id);
        })
        ->get();
        $infor_company =  Company::all();

        $district = District::all();
        $user_district = User::with('district')->get();
        // dd($user_district);
        // Công việc gần đây nhất
        $work_current = DB::table('users')
                ->join('work_users','users.user_id','=','work_users.user_id')
                ->join('works','work_users.work_id','=','works.work_id')
                ->join('work_companies','works.work_id','=','work_companies.work_id')
                ->join('companies','work_companies.company_id','=','companies.company_id')
                ->select('works.*','companies.*')
                ->where('work_users.user_id','=',Auth::user()->user_id)
                ->latest('work_users.created_at','desc')->first();

        $works_status = Work::with('work_users')
        ->join('work_users','works.work_id','=','work_users.work_id')
        ->where([
            ['works.work_status','working'],
            ['work_users.user_id','=',Auth::user()->user_id]
        ])->get();


        $works_lastest = DB::table('users')
                ->join('work_users','users.user_id','=','work_users.user_id')
                ->join('works','work_users.work_id','=','works.work_id')
                ->join('work_companies','works.work_id','=','work_companies.work_id')
                ->join('companies','work_companies.company_id','=','companies.company_id')
                ->select('works.*','companies.*')
                ->where('work_users.user_id','=',Auth::user()->user_id)
                ->latest('work_users.created_at','desc')->first();

        
        $work_your_self = DB::table('users')
        ->join('work_users','users.user_id','=','work_users.user_id')
        ->join('works','work_users.work_id','=','works.work_id')
        ->join('work_companies','works.work_id','=','work_companies.work_id')
        ->join('companies','work_companies.company_id','=','companies.company_id')
        ->select('users.*','work_users.*','works.*','companies.*')
        ->get();
        $result = '';
        if(isset($works_lastest->work_begin) && isset($works_lastest->work_end))
        {
            // dd($works_lastest->work_begin);
            $work_begin = Carbon::parse($works_lastest->work_begin);
            $work_end = Carbon::parse($works_lastest->work_end);
    
            $result = $work_begin->diffInDays($work_end,false);
    
            //echo "Số ngày nghỉ việc của bạn là : " .$result;
    
            if($result < 0)
            {
                $result = 'Ngày nghỉ việc bị sai số hoặc bạn chưa thiết lập ngày nghỉ việc';
            }
            // return $result;
        }

        // TODO 1 là người dùng này chưa có công việc , (tìm trong bảng work_users có thể thêm nhiều công việc thì TRƯỜNG HỢP SỐ 1 bỏ)
        // TODO 2 là người dùng này đã nghỉ việc rồi mới hiện ra form thêm công việc . Chứ ko cho thêm tùy tiện !


        // TODO Nếu công việc hiện tại (gần đây nhất) của người dùng Auth là Nghỉ việc
        $accept_add = Work::with('work_users')
            ->join('work_users','works.work_id','=','work_users.work_id')
            ->where([
                ['work_users.user_id','=',Auth::user()->user_id],
                ['work_status','=','resigned'],
                ])
            ->latest('work_users.created_at','desc')->first();
        // dd($query);

        // TODO SUCCESSFULLY
        // TODO Đếm xem trong bảng work_users của người dùng Auth có công việc(work_id) chưa?
        $que = Work::with('work_users')
                ->join('work_users','works.work_id','=','work_users.work_id')
                ->whereHas('work_users',function($query){
                    $query->join('works','work_users.work_id','=','works.work_id')
                    ->select(DB::raw('count(work_users.work_id) as userID'))
                    ->where('work_users.user_id',Auth::user()->user_id)
                    ->groupBy('work_users.work_id')
                    ->get();
                })
                ->where('work_users.user_id',Auth::user()->user_id)
                ->get();
        //dd(count($que));
        //dd($query);

        // Nếu chưa nghỉ việc ở công ty cũ thì sẽ ko được thêm công việc mới
        $duoc_them = "Y";
        $ko_duoc_them = "N";
        if(isset($accept_add) > 0 || count($que) == 0)      // TODO ĐƯỢC THÊM CÔNG VIỆC (vì work_status == resigned)
        {
            $accept_add = $duoc_them;
            // echo $accept_add;
        }
        else{
            $accept_add = $ko_duoc_them;
            // echo $accept_add;
        }
        
        return view('pages.admins.accounts.profile_new')
        ->with('accounts',$accounts)
        ->with('infor_company',$infor_company)
        ->with('accounts',$accounts)
        ->with('majors',$majors)
        ->with('roles',$roles)
        ->with('district',$district)
        ->with('user_district',$user_district)
        ->with('works',$works)
        ->with('work_current',$work_current)
        ->with('works_status',$works_status)
        ->with('works_lastest',$works_lastest)
        ->with('work_your_self',$work_your_self)
        ->with('result',$result)
        ->with('accept_add',$accept_add);

    }


    // TODO CẬP NHẬT CÔNG VIỆC HIỆN TẠI
    public function update_job(Request $request,$workID)
    {
        $work = Work::findOrFail($workID);
        $work->work_specialize = $request->get('work_specialize');
        $work->work_name       = $request->get('work_name');
        $work->work_begin      = $request->get('work_begin');
        $company = Company::with('company_works')
            ->join('work_companies','companies.company_id','=','work_companies.company_id')
            ->where([
                ['work_companies.work_id','=',$workID],
            ])
            ->first();
        //dd($company);
        $company->company_name = $request->get('company_name');
        $company->company_tel = $request->get('company_tel');
        $company->company_email = $request->get('company_email');
        $company->company_address = $request->get('company_address');

        //dd([$work,$company]);
        $company->save();
        $work->save();

        return back()->with('success','Cập nhật việc làm thành công');
    }


    // TODO CẬP NHẬT PROFILE
    public function update_profile(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->code           =   $request->get('code');
        $user->course         =   $request->get('course');
        $user->name           =   $request->get('name');
        $user->email          =   $request->get('email');
        $user->other_email    =   $request->get('other_email');
        $user->password       =   Hash::make($request->get('password'));
        $user->nation         =   $request->get('nation');
        $user->tel            =   $request->get('tel');
        $user->email          =   $request->get('email');
        $user->birth          =   $request->get('birth');
        $user->address        =   $request->get('address');
        $user->district_id    =   $request->input('district_id');

        // dd($user);
        $user->save();
        return back()->with('success','Updated Data Successfully');
    }

    public function add_other_email(Request $request, $userID)
    {
        $user = User::findOrFail($userID);
        $user->other_email = $request->get('other_email');
        // dd($user);
        $user->save();
        return back()->with('success','Thêm email liên hệ khác thành công !');
    }

    // TODO HIỂN THỊ CÔNG VIỆC CỦA NGƯỜI DÙNG 
    public function jobs()
    {
        $work_current = DB::table('users')
                ->join('work_users','users.user_id','=','work_users.user_id')
                ->join('works','work_users.work_id','=','works.work_id')
                ->join('work_companies','works.work_id','=','work_companies.work_id')
                ->join('companies','work_companies.company_id','=','companies.company_id')
                ->select('works.*','companies.*')
                ->where('work_users.user_id','=',Auth::user()->user_id)
                ->latest('work_users.created_at','desc')->first();

        $works_status = Work::with('work_users')
        ->join('work_users','works.work_id','=','work_users.work_id')
        ->where([
            ['works.work_status','working'],
            ['work_users.user_id','=',Auth::user()->user_id]
        ])->get();
        //dd($works_status);

        $accounts = DB::table('users')->get();
        $infor_company = Company::all();

        //dd($query);
        return view('pages.admins.accounts.jobs')
        ->with('accounts',$accounts)
        ->with('works_status',$works_status)
        ->with('work_current',$work_current)
        ->with('infor_company',$infor_company);
    }


    // TODO: HIỂN THỊ CÔNG VIỆC HIỆN TẠI GẦN NHẤT ĐANG LÀM VÀ CHỨC NĂNG NGHỈ VIỆC
    public function show_current_work_and_resign()
    {
        // Lấy ra công việc cuối cùng của người dùng này làm .
        $works = DB::table('users')
                ->join('work_users','users.user_id','=','work_users.user_id')
                ->join('works','work_users.work_id','=','works.work_id')
                ->join('work_companies','works.work_id','=','work_companies.work_id')
                ->join('companies','work_companies.company_id','=','companies.company_id')
                ->select('works.*','companies.*')
                ->where('work_users.user_id','=',Auth::user()->user_id)
                ->latest('work_users.created_at','desc')->first();
        
        $result = '';
        if(isset($works->work_begin) && isset($works->work_end))
        {
            $work_begin = Carbon::parse($works->work_begin);
            $work_end = Carbon::parse($works->work_end);
    
            $result = $work_begin->diffInDays($work_end,false);
    
            //echo "Số ngày nghỉ việc của bạn là : " .$result;
    
            if($result < 0)
            {
                $result = 'Ngày nghỉ việc bị sai số hoặc bạn chưa thiết lập ngày nghỉ việc';
            }
            // return $result;
        }
        
        return view('pages.admins.accounts.show_current_work_resign')
        ->with('works',$works)
        ->with('result',$result);
    }
    public function add_work_submit(Request $request)
    {
        $accounts = DB::table('users')->get();
        $infor_company =  Company::all();
        $works = DB::table('users')
        ->join('work_users','users.user_id','=','work_users.user_id')
        ->join('works','work_users.work_id','=','works.work_id')
        ->select('users.*','work_users.*','works.*')
        ->get();

        $work = new Work();
        $work->work_specialize          = $request->get('work_specialize');
        $work->work_salary              = $request->get('work_salary');
        $work->work_name                = $request->get('work_name');
        $work->work_begin               = $request->get('work_begin');
        $work->work_end                 = $request->get('work_end');
        // dd($work);
        $work->save();
        $work->work_users()->attach(Auth::user()->user_id);
        $work->work_users()->attach($work->work_id);
        $work->work_users()->detach($work->work_id);

        $company = new Company();
        if(request()->get('company_id')){
            $company->company_id            = $request->get('company_id');

            $work->save();
            $company->company_works()->attach($work->work_id);
            $company->company_works()->attach($company->company_id);
            $company->company_works()->detach($company->company_id);
        }
        else
        {
            $company->company_id            = $request->get('company_id');
            $company->company_name          = $request->get('company_name');
            $company->company_address       = $request->get('company_address');
            $company->company_tel           = $request->get('company_tel');
            $company->company_email         = $request->get('company_email');
            $company->company_website       = $request->get('company_website');
            //dd($company);

            $work->save();
            $company->save();
            $company->company_works()->attach($work->work_id);
            $company->company_works()->attach($company->company_id);
            $company->company_works()->detach($company->company_id);
        }
        // $company->company_id            = $request->get('company_id');
        // $company->company_name          = $request->get('company_name');
        // $company->company_address       = $request->get('company_address');
        // $company->company_tel           = $request->get('company_tel');
        // $company->company_email         = $request->get('company_email');
        // //dd($company);

        // $work->save();
        // $company->save();
        // $company->company_works()->attach($work->work_id);
        // $company->company_works()->attach($company->company_id);
        // $company->company_works()->detach($company->company_id);

        echo $work . '<br>';
        echo $company . '<br>';

        return redirect('accounts/show_work_yourself')
        ->with('works',$works)
        ->with('accounts',$accounts)
        ->with('infor_company',$infor_company)
        ->with('success','Added information of job successfully');

        echo $work.'<br>';
        echo $company.'<br>';

        return view('pages.admins.accounts.profile')->with('success', 'Added information of job successfully');
    }

    public function resign_ajax(Request $request)
    {
        if(request()->ajax())
        {
            $workID = $request->get('workID');
            DB::table('works')->where('work_id',$workID)->update(['work_status' => 'resigned']);
            $workEnd = $request->get('workEnd');
            
            DB::table('works')->where('work_id',$workID)->update(['work_end' => $workEnd]);
            return response()->json(["result" => "success",'workEnd' => 'successworkEnd']);
        }
    }
    public function show_work()
    {
        $works = DB::table('users')
                ->join('work_users','users.user_id','=','work_users.user_id')
                ->join('works','work_users.work_id','=','works.work_id')
                ->join('work_companies','works.work_id','=','work_companies.work_id')
                ->join('companies','work_companies.company_id','=','companies.company_id')
                ->select('users.*','work_users.*','works.*','companies.*')
                ->get();
        //dd($works);
        return view('pages.admins.accounts.show')
        ->with('works', $works);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function change_password()
    {
        return view('auth.change_password');
    }

    public function update_password(Request $request)
    {
        $this->validate($request,[
            'oldPassword'   => 'required',
            'password'      => 'required|confirmed'
        ]);

        $hashPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $hashPassword))
        {
            $user = User::findOrFail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return \redirect()->route('login')->with('success','Bạn đã thay đổi mật khẩu thành công.');
        }
        else
        {
            return \redirect()->back()->with('error','Mật khẩu bạn nhập không đúng');
        }
    }
}

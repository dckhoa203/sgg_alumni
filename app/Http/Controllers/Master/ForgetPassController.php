<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\ResetPassword;
use Sentinel;
use Reminder;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ResetPass;
use Symfony\Component\Console\Input\Input;
use DB;
use Illuminate\Support\Facades\Hash;
class ForgetPassController extends Controller
{
    public function index()
    {
        return view('pages.admins.forget_password.index');
    }

    public function update(Request $request)
    {
        $user =  User::whereEmail($request->email)->first();
        
        if($user == NULL)
        {
            return redirect()->back()->with('error','Email not Exist!');
        }
        $token = str_random(10);
        $users = new ResetPassword();
        $users->user_id = $user->user_id;
        $users->password_token = $token;
        // dd($users);
        $users->save();

        Mail::to($request->email)->send(new ResetPass($user->user_id,$user->email,$users->password_token));

        return back()->with('success','Vui lòng kiểm tra mail của bạn!');
        
    }

    public function get_url_token($userID,$email,$token)
    {
        $conflict_token = DB::table('reset_passwords')
        ->join('users','reset_passwords.user_id','=','users.user_id')    
        ->where([
                ['reset_passwords.password_token','=',$token],
                ['reset_passwords.user_id','=',$userID],
                ['users.email',$email]
            ])
            
            ->first();
            // dd($conflict_token);
        if($conflict_token == true)   
        {
            return redirect()->route('forget_passwords.update_password',['userID'=>$userID,'email'=>$email,'token'=> $token])->with('success','Redirect thanh cong');        
        }
        else{
        return redirect()->route('forget_passwords.index');
        }
    }

    public function update_password($userID,$email,$token)
    {
        $user = DB::table('users')
        ->join('reset_passwords','users.user_id','=','reset_passwords.user_id')
        ->where('reset_passwords.user_id','=',$userID)
        ->first();
        if(isset($user))
        {
            return view('pages.admins.forget_password.update_password',compact('user'));
        }
        else{
            return redirect()->route('forget_passwords.index');
        }
        
    }

    public function update_password_submit(Request $request, $userID)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::findOrFail($userID);
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return redirect()->route('login')->with('success','Cập nhật mật khẩu thành công');
    }

}

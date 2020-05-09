<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MailLog;
use Carbon\Carbon;
use Mail;
use App\Mail\SendEmail;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Swift_RfcComplianceException;

class SendEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admins.mails.send_mail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_class_url($slash = null)
    {
        if($slash)
        {
            $classes = Classes::join('class_users','classes.class_id','=','class_users.class_id')
                ->join('users','class_users.user_id','=','users.user_id')
                ->where([
                    ['classes.class_id',$slash],
                    ['class_users.class_user_accountability','=','sinh viên']
                ])
                ->get();
            // dd($classes);

            $string = "";
            foreach ($classes as $item) {
                $list_mails[$item->class_id] = $item->email.",";
                $result = implode(", ",$list_mails);
                $string .= $result;
            }
            $final = rtrim($string, ", ");
            return view('pages.admins.mails.send_mail',['final' => $final]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // $this->validate($request,[
            //     'email.*.email' => 'email|unique:users',
            //     'subject'    => 'required',
            //     'message'    => 'required',
            //     'file.*'    => 'mimes:pdf,doc,docx,zip'
            // ]);
            // $mails = new MailLog();

            // $mails->mail_log_to             = $request->get('email');
            // $mails->mail_log_subject        = $request->get('subject');
            // $mails->mail_log_body           = $request->get('message');
            // $mails->mail_log_send_datetime  = Carbon::now(); 
            // $mails->mail_log_file           = $request->file('file');
            
            $data = array(
                'email'              => $request->get('email'),
                'multiple_address'   => $request->input('multiple_emails'),
                'list_mails_class'   => $request->list_mails_class,
                'subject'            => $request->get('subject'),
                'message'            => $request->get('message'),
                'date_time'          => Carbon::now(),
                'file'               => $request->file('file'),   
            );

            $files = $request->file('file');
            $files->move(public_path('\files'), $files->getClientOriginalName());
            // dd($data['file']);
            // TODO DANH SÁCH EMAIL TRÊN LỚP CỦA CỐ VẤN
            $list_mails = $data["list_mails_class"];
            
            $return_list_mails = explode(",",$list_mails);
            // dd($return_list_mails);
            
            // TODO DANH SÁCH MAIL CHO NGƯỜI DÙNG NHẬP MUỐN GỬI NHIỀU NGƯỜI
            $emails = $data['multiple_address'];
            // dd($emails);
            $list_emails = explode(",",$emails);
            // dd($list_emails);

            
            if(isset($data['email']))   // GỬI MỘT NGƯỜI
            {
                Mail::to($data['email'])->send(new SendEmail($data['subject'],$data['message'],$data['date_time'],$files));
            }
            if(isset($list_emails)){
                foreach ($list_emails as $mail) {
                    Mail::to($mail)->send(new SendEmail($data['subject'],$data['message'],$data['date_time'],$data['file']));
                }
                
            }
            if(isset($return_list_mails))
            {
                foreach ($return_list_mails as $student_mail) {
                    Mail::to($student_mail)->send(new SendEmail($data['subject'],$data['message'],$data['date_time'],$data['file']));
                }
                
            }
        } catch (Swift_RfcComplianceException $ex){
            return back()->with('success','Đã gửi mail thành công !');
        }
        echo $data['file'];
        return back()->with('success','Đã gửi mail thành công !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

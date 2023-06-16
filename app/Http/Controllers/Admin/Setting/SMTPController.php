<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\SMTP;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SMTPController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $smtp = SMTP::get()->first();
        return view('admin.setting.smtp.index',[
            'smtp' => $smtp,
        ]);
    }

    //upadte
    function smtp_update(Request $request,$id)
    {
        //return $id;
        SMTP::where('id',$id)->update([
            'mailer'=> $request->mailer,
            'host'=> $request->host,
            'port'=> $request->port,
            'user_name'=> $request->user_name,
            'password'=> $request->password,
            'created_at' => Carbon::now(),
        ]);
        
        $message = array('message' => 'SMTP Setting Updated Successfully.!',
        'alert-type' => 'success',       
            );
            return back()->with($message);
        
    }
}

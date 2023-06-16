<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Image;
class WebsiteController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $website_info = WebsiteSetting::get()->first();
        return view('admin.setting.website.index',[
            'website_info' => $website_info,
        ]);
    }

    //upadte
    function website_update(Request $request,$id)
    {
        // return $id;
        $data = array();
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['main_mail'] = $request->main_mail;
        $data['support_mail'] = $request->support_mail;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['linkedin'] = $request->linkedin;
        $data['youtube'] = $request->youtube;
        if($request->logo)
        {
            $image = $request->logo;
            $extension = $image->getClientOriginalExtension();
            $image_name = $id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/logo/').$image_name)->resize(150,150);
            $data['logo'] = $image_name;
        }
        
        if($request->favicon)
        {
            $image = $request->favicon;
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid().'-'.$id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/logo/').$image_name)->resize(150,150);
            $data['favicon'] = $image_name;
        }
        
        WebsiteSetting::where('id',$id)->update($data);
        $message = array('message' => 'Website Setting Updated Successfully.!',
        'alert-type' => 'success',       
            );
        return back()->with($message);
        
    }
}

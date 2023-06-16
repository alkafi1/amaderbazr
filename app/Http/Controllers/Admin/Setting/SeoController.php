<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $seos = Seo::get()->first();
        return view('admin.setting.seo.index',[
            'seos' => $seos,
        ]);
    }

    //upadte
    function seo_update(Request $request,$id)
    {
        //return $id;
        Seo::where('id',$id)->update([
            'meta_title'=> $request->meta_title,
            'meta_author'=> $request->meta_author,
            'meta_tag'=> $request->meta_tag,
            'meta_keyword'=> $request->meta_keyword,
            'meta_description'=> $request->meta_description,
            'googel_varification'=> $request->meta_title,
            'google_analytics'=> $request->google_analytics,
            'google_adsense'=> $request->google_adsense,
            'alexa_verification'=> $request->alexa_varification,
            'created_at' => Carbon::now(),
        ]);
        
        $message = array('message' => 'SEO Setting Updated Successfully.!',
        'alert-type' => 'success',       
            );
            return back()->with($message);
        
    }
}

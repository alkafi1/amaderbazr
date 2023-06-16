<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class PageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $pages = Page::all();
        return view('admin.setting.page.index',[
            'pages' => $pages,
        ]);
    }

    //create page
    function page_create()
    {
        return view('admin.setting.page.create_page');
    }

    //page store
    function page_store(Request $request)
    {
    //    return $request->all();
       Page::insert([
        'page_position' => $request->page_position,
        'page_name' => $request->page_name,
        'page_title' => $request->page_title,
        'page_slug' => Str::slug($request->page_title, '-'),
        'page_description' => $request->page_description,
        'created_at' => Carbon::now(),
       ]);
       $message = array('message' => 'Page Create Successfully.!',
        'alert-type' => 'success',       
            );
        return redirect()->route('page.index')->with($message);
    }
    //page edit
    function page_edit($id)
    {
        $page = Page::where('id',$id)->first();
        return view('admin.setting.page.edit',[
            'page' => $page,
        ]);
    }
    function page_update(Request $request,$id)
    {
    //    return $request->all();
       Page::where('id',$id)->update([
        'page_position' => $request->page_position,
        'page_name' => $request->page_name,
        'page_title' => $request->page_title,
        'page_slug' => Str::slug($request->page_title, '-'),
        'page_description' => $request->page_description,
        'created_at' => Carbon::now(),
       ]);
       $message = array('message' => 'Page Update Successfully.!',
        'alert-type' => 'success',       
            );
        return redirect()->route('page.index')->with($message);
    }

    //page delete
    function page_delete($id)
    {
        Page::where('id',$id)->delete();
        $message = array('message' => 'Page Delete Successfully.!',
        'alert-type' => 'success',       
            );
        return redirect()->route('page.index')->with($message);

    }
}

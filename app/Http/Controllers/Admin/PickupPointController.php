<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PickupPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PickupPointController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //all warehouse showing
    function index(Request $request)
    {
        
        if($request->ajax()){
            
            $pickup_point = PickupPoint::all();
            return DataTables::of($pickup_point)
                                ->addIndexColumn()
                                ->addColumn('action', function($pickup_point){
                                    $action_btn = '<a href="" class="btn btn-info btn-sm" id="edit" data-id="'.$pickup_point->id.'"  data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i></a>
                                    <a href="'.route('pickuppoint.delete',[$pickup_point->id]).'" class="btn btn-danger btn-sm" id="delete_yajra"><i class="fas fa-trash"></i></a>';
                                    return $action_btn;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
            
        }
        return view('admin.pickuppoint.index');
    }

    //store pickuppoint
    function pickuppoint_store(Request $request)
    {
        
        PickupPoint::insert([
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
            'created_at' => Carbon::now(),
        ]);
        return response()->json('Pickup point Insert Successfully');
    }
    //edit pickuppoint_edit
    function pickuppoint_edit( $id)
    {
        $pickup_point = PickupPoint::where('id',$id)->first();
        return view('admin.pickuppoint.edit',[
            'pickup_point' =>$pickup_point,
        ]);
    }
    //Update ware hosue
    function pickuppoint_update(Request $request,$id)
    {
        
        PickupPoint::where('id',$id)->update([
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
        ]);
        return response()->json('Pickup Point Update Successfully');
    }

    //warehouse delete
    function pickuppoint_delete($id)
    {
        PickupPoint::where('id',$id)->delete();
        return response()->json('Pickup Point Delete Successfully');
    }
}

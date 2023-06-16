<?php

namespace App\Http\Controllers\Admin\Offer;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //all warehouse showing
    function index(Request $request)
    {
        
        if($request->ajax()){
            
            $coupons = Coupon::all();
            return DataTables::of($coupons)
                                ->addIndexColumn()
                                ->addColumn('action', function($coupons){
                                    $action_btn = '<a href="" class="btn btn-info btn-sm" id="edit" data-id="'.$coupons->id.'"  data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i></a>
                                    <a href="'.route('coupon.delete',[$coupons->id]).'" class="btn btn-danger btn-sm" id="delete_coupon"><i class="fas fa-trash"></i></a>';
                                    return $action_btn;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
            
        }
        return view('admin.offer.coupon.index');
    }

    //store ware hosue
    function coupon_store(Request $request)
    {
        // return $request->all();
        // $request->validate([
        //     'coupon_code' => 'required',
        //     'valid_date' => 'required',
        //     'type' => 'required',
        //     'coupon_amount' => 'required',
        // ]);
        // return 'a';
        Coupon::insert([
            'coupon_code' => $request->coupon_code,
            'valid_date' => $request->valid_date,
            'type' => $request->type,
            'coupon_amount' => $request->coupon_amount,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);
        return response()->json('Coupon Insert Successfully');
    }
    //edit ware hosue
    function coupon_edit( $id)
    {
        // return $request->all();
        $coupon = Coupon::where('id',$id)->first();
        return view('admin.offer.coupon.edit',[
            'coupon' =>$coupon,
        ]);
    }
    //Update ware hosue
    function coupon_update(Request $request,$id)
    {
        Coupon::where('id',$id)->update([
            'coupon_code' => $request->coupon_code,
            'valid_date' => $request->valid_date,
            'type' => $request->type,
            'coupon_amount' => $request->coupon_amount,
        ]);
        $message = array('message' => 'Coupon Update Successfully.!',
            'alert-type' => 'success',       
                );
                return response()->json('Coupon Update Successfully');
    }

    //warehouse delete
    function coupon_delete($id)
    {
        Coupon::where('id',$id)->delete();
        return response()->json('Coupon Delete Successfully');
    }
}

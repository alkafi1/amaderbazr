<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
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
            
            $warehouses = Warehouse::all();
            return DataTables::of($warehouses)
                                ->addIndexColumn()
                                ->addColumn('action', function($warehouse){
                                    $action_btn = '<a href="" class="btn btn-info btn-sm" id="edit" data-id="'.$warehouse->id.'"  data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i></a>
                                    <a href="'.route('warehouse.delete',$warehouse->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                                    return $action_btn;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
            
        }
        return view('admin.category.warehouse.index');
    }

    //store ware hosue
    function warehouse_store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);
        Warehouse::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $message = array('message' => 'Warehouse Added Successfully.!',
            'alert-type' => 'success',       
                );
        return back()->with($message);
    }
    //edit ware hosue
    function warehouse_edit( $id)
    {
        // return $request->all();
        $warehouse = Warehouse::where('id',$id)->first();
        return view('admin.category.warehouse.edit',[
            'warehouse' =>$warehouse,
        ]);
    }
    //Update ware hosue
    function warehouse_update(Request $request,$id)
    {
        // return $request->all();
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);
        Warehouse::where('id',$id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $message = array('message' => 'Warehouse Update Successfully.!',
            'alert-type' => 'success',       
                );
        return back()->with($message);
    }

    //warehouse delete
    function warehouse_delete($id)
    {
        Warehouse::where('id',$id)->delete();
        $message = array('message' => 'Warehouse Deelete Successfully.!',
            'alert-type' => 'success',       
                );
        return back()->with($message);
    }
}

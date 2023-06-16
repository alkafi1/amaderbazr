@extends('layouts.admin_layout')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CWareHOuse</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#warehouseModal">+ Add New</button>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Warehouses Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-hover ytable">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Warehouse Name</th>
                    <th>Warehouse Phone</th>
                    <th>Warehouse Address</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Warehouse Name</th>
                    <th>Warehouse Phone</th>
                    <th>Warehouse Address</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
{{-- Warehouse modal --}}
  <div class="modal fade" id="warehouseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Warehouse</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{route('warehouse.store')}}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Warehouse Name</label>
                  <input type="text" class="form-control"  name="name" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Warehouse Phone</label>
                  <input type="text" class="form-control"  name="phone" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Wahrehouse Address</label>
                  <input type="text" class="form-control" name="address">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  {{-- edit modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Warehouse Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal-body">

        </div>
      </div>
      </div>
    </div>
  
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
   <script type="text/javascript">
        
        $(document).ready(function() {
          
           var table = $('.ytable').DataTable({
              processing: true,
              serverSide:true,
              autoWidth: false,
              ajax: "{{ route('warehouse.index') }}",
              columns:[
                {data:'DT_RowIndex' ,name:'DT_RowIndex'},
                {data:'name' ,name:'name'},
                {data:'phone' ,name:'phone'},
                {data:'address' ,name:'address'},
                {data:'action' ,name:'action',orderable:true,serachable:true,sClass:'text-center'},
              ]
           });
           $('body').on('click','#edit',function(){
            let id = $(this).data('id');
            $.get('warehouse/edit/'+id,function(data){
              $('#modal-body').html(data);
            })
        });
         })
      </script>
@endsection
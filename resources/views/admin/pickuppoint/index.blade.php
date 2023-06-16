@extends('layouts.admin_layout')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pickup Point </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">+ Add New</button>
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
                <h3 class="card-title">All Pickup Points Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-hover ytable">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Pickup Pont Name</th>
                    <th>Pickup Pont Address</th>
                    <th>Pickup Pont Phone</th>
                    <th>Pickup Pont Phone 2</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                  
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Pickup Pont Name</th>
                    <th>Pickup Pont Address</th>
                    <th>Pickup Pont Phone</th>
                    <th>Pickup Pont Phone 2</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                <form action="" method="delete" id="delete_form">
                  @csrf @method('DELETE')
                </form>
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
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Pickup Point</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{route('pickuppoint.store')}}" id="add_form">
            @csrf
        <div class="modal-body">
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Pickup Point Name</label>
                  <input type="text" class="form-control"  name="pickup_point_name" value="" required>
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Pickup Point Address</label>
                  <input type="text" class="form-control"  name="pickup_point_address" value="" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Pickup Point Phone</label>
                  <input type="text" class="form-control"  name="pickup_point_phone" value="" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Pickup Point Phone <small>Optional*</small></label>
                  <input type="text" class="form-control"  name="pickup_point_phone_two" value="" >
                  
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary cl" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><small class="loading d-none">....Lading</small> Submit</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Pickup Point Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modal-body"></div>
      </div>
      </div>
    </div>
  
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
   <script type="text/javascript">
        $(document).ready(function() {
          //make yeajra data table
          table = $('.ytable').DataTable({
            processing: true,
            serverSide:true,
            autoWidth: false,
            ajax: "{{ route('pickuppoint.index') }}",
            columns:[
              {data:'DT_RowIndex' ,name:'DT_RowIndex'},
              {data:'pickup_point_name' ,name:'pickup_point_name'},
              {data:'pickup_point_address' ,name:'pickup_point_address'},
              {data:'pickup_point_phone' ,name:'pickup_point_phone'},
              {data:'pickup_point_phone_two' ,name:'pickup_point_phone_two'},
              // {data:'status' ,name:'status',render: function (data, type, row) {
              //         if (row.status == 1) {
              //             return 'Active'; // Display the email as it is
              //         } else {
              //             return 'Deactive'; // Display a custom message
              //         }
              //       }
              // },
              {data:'action' ,name:'action',orderable:true,serachable:true,sClass:'text-center'},
            ]
          });
          //edit request
          $('body').on('click','#edit',function(){
            let id = $(this).data('id');
            $.get('pickuppoint/edit/'+id,function(data){
              $('#modal-body').html(data);
            })
          });
          
          //add coupon
          $("#add_form").submit(function(e){
            e.preventDefault();
            var link = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
              url : link,
              type : 'post',
              async:false,
              data : request,
              success:function(data){
                toastr.success(data);
                $('#add_form')[0].reset();
                $('#addModal').modal('hide');
                table.ajax.reload();
              }
            });
          });
          
          //delete coupon
          $(document).on("click","#delete_yajra", function(e){
              e.preventDefault();
              let link = $(this).attr('href');
              $('#delete_form').attr('action',link);
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              })
              .then((result) => {
                if (result.isConfirmed) {
                  $('#delete_form').submit();
                }else{
                  Swal.fire({title: 'Data safe'});
                }
              })
          });
          //data submit for delete
          $("#delete_form").submit(function(e){
            e.preventDefault();
            var link = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
              url : link,
              type : 'post',
              async:false,
              data : request,
              success:function(data){
                toastr.success(data);
                $('#delete_form')[0].reset();
                table.ajax.reload();
              }
            });
          });
        })
        
        
        
        
  </script>
@endsection
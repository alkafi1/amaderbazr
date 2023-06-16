@extends('layouts.admin_layout')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Coupon</h1>
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
                <h3 class="card-title">All Coupons Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-hover ytable">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Coupon Code</th>
                    <th>Valid Date</th>
                    <th>Coupon Type</th>
                    <th>Coupon Amount</th>
                    <th>Coupon Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                  
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Coupon Code</th>
                    <th>Valid Date</th>
                    <th>Coupon Type</th>
                    <th>Coupon Amount</th>
                    <th>Coupon Status</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="{{route('coupon.store')}}" id="add_coupon">
            @csrf
        <div class="modal-body">
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Coupon Code</label>
                  <input type="text" class="form-control"  name="coupon_code" value="" required>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Type</label>
                  <select name="type" id="" class="form-control" required>
                    <option value="1">Percentage</option>
                    <option value="2">Flat Amount</option>
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Coupo Amount</label>
                  <input type="number" class="form-control"  name="coupon_amount" value="" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Valid Date</label>
                  <input type="date" class="form-control"  name="valid_date" value="">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Coupon Status</label>
                  <select name="status" id="" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="2">Deactive</option>
                  </select>
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
          <h5 class="modal-title" id="exampleModalLabel">Coupon Edit</h5>
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
            ajax: "{{ route('coupon.index') }}",
            columns:[
              {data:'DT_RowIndex' ,name:'DT_RowIndex'},
              {data:'coupon_code' ,name:'coupon_code'},
              {data:'valid_date' ,name:'valid_date'},
              {data:'type' ,name:'type'},
              {data:'coupon_amount' ,name:'coupon_amount'},
              {data:'status' ,name:'status',render: function (data, type, row) {
                      if (row.status == 1) {
                          return 'Active'; // Display the email as it is
                      } else {
                          return 'Deactive'; // Display a custom message
                      }
                    }
              },
              {data:'action' ,name:'action',orderable:true,serachable:true,sClass:'text-center'},
            ]
          });
          //edit request
          $('body').on('click','#edit',function(){
            let id = $(this).data('id');
            $.get('coupon/edit/'+id,function(data){
              $('#modal-body').html(data);
            })
          });
          
          //add coupon
          $("#add_coupon").submit(function(e){
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
                $('#add_coupon')[0].reset();
                $('#addModal').modal('hide');
                table.ajax.reload();
                
              }
            });
          });
          
          //delete coupon
          $(document).on("click","#delete_coupon", function(e){
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
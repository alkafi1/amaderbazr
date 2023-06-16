@extends('layouts.admin_layout')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button class="btn btn-primary" data-toggle="modal">+ Add New</button>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Product Here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="" class="table table-bordered table-hover ytable" width="100%">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Category Name</th>
                    <th>SubCategory Name</th>
                    <th>childCategory Name</th>
                    <th>Brand Name</th>
                    <th>Purchase Price</th>
                    <th>Selling Price</th>
                    <th>Discount Price</th>
                    <th>Featured</th>
                    <th>Todays Deal</th>
                    <th>Status</th>
                    <th>Thumbnail</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                  
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Category Name</th>
                    <th>SubCategory Name</th>
                    <th>childCategory Name</th>
                    <th>Brand Name</th>
                    <th>Purchase Price</th>
                    <th>Selling Price</th>
                    <th>Discount Price</th>
                    <th>Featured</th>
                    <th>Todays Deal</th>
                    <th>Status</th>
                    <th>Thumbnail</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
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


  
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
   <script type="text/javascript">
        $(document).ready(function() {
          //make yeajra data table
          table = $('.ytable').DataTable({
            processing: true,
            serverSide:true,
            autoWidth: false,
            // scrollX: true,
            ajax: "{{ route('product.index') }}",
            columns:[
              {data:'DT_RowIndex' ,name:'DT_RowIndex'},
              {data:'name' ,name:'name'},
              {data:'code' ,name:'code'},
              {data:'category_name' ,name:'category_name'},
              {data:'subcategory_name' ,name:'subcategory_name'},
              {data:'childcategory_name' ,name:'childcategory_name'},
              {data:'brand_name' ,name:'brand_name'},
              {data:'purchase_price' ,name:'purchase_price'},
              {data:'selleing_price' ,name:'selleing_price'},
              {data:'discount_price' ,name:'discount_price'},
              {data:'featured' ,name:'featured'},
              {data:'todays_deals' ,name:'todays_deals'},
              {data:'status' ,name:'status'},
              {data:'thumnail' ,name:'thumnail',"render": function (data, type, full, meta) {
                                            var imagePath = "{{asset('uploads/product/thumbnail/')}}/" + data;
                                            return '<img src="' + imagePath + '" alt="product Image" width="50">'},
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
          
          //status change
          $(document).on("click",".status", function(e){
              e.preventDefault();
              let id= $(this).attr('id');
              let link = "{{url('product/status')}}/"+id;
              
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't to Deactive",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Deactive it!'
              })
              .then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url : link,
                    type : 'get',
                    success:function(data){
                      toastr.success(data);
                      table.ajax.reload();
                    }
                  });
                }
              })
          });
          //featurede change
          $(document).on("click",".featured", function(e){
              e.preventDefault();
              let id= $(this).attr('id');
              let link = "{{url('product/featured')}}/"+id;
              $.ajax({
                    url : link,
                    type : 'get',
                    success:function(data){
                      toastr.success(data);
                      table.ajax.reload();
                    }
                  });
              
          });
          //todays_deals change
          $(document).on("click",".todays_deals", function(e){
              e.preventDefault();
              let id= $(this).attr('id');
              let link = "{{url('product/todays_deals')}}/"+id;
              $.ajax({
                    url : link,
                    type : 'get',
                    success:function(data){
                      toastr.success(data);
                      table.ajax.reload();
                    }
                  });
              
          });
          //delete yajra
          $(document).on("click","#delete_product", function(e){
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
            }).then((result) => {
              if (result.isConfirmed) {
                $('#delete_form').submit();
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
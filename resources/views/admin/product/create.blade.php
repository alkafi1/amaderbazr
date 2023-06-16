@extends('layouts.admin_layout')

@section('admin_content')
<style type="text/css">
    .bootstrap-tagsinput .tag {
            background: rgb(22, 22, 43);
            border: 1px solid white;
            padding: 1 6px;
            padding-left:2px;
            margin-right:2px;
            color:white;
            border-radius :4px;
        }
    </style>
    
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>New Product</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Product Infromation</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                          <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" class="form-control" name="name"  placeholder="Product Name" value="{{old('name')}}">
                                    @error('name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Product Code</label>
                                    <input type="text" class="form-control"   name="code" placeholder="Product Code" value="{{old('code')}}">
                                    @error('code')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Category*</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category) 
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Subcategory*</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        <option value="">-- Select SubCategory --</option>
                                    </select>
                                    @error('subcategory_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Childcategory*</label>
                                    <select name="childcategory_id" id="childcategory_id" class="form-control">
                                        <option value="">-- Select Child Category --</option>
                                        
                                    </select>
                                    @error('childcategory_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Brand</label>
                                    <select name="brand_id" id="" class="form-control">
                                        <option value="">-- Select Brand --</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Warehouse*</label>
                                    <select name="warehouse_id" id="warehouse_id" class="form-control">
                                        <option value="">-- Select Warehouse --</option>
                                        @foreach ($warehouses as $warehouse) 
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('warehouse_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Pickup Point</label>
                                    <select name="pickup_point_id" id="pickup_point_id" class="form-control">
                                        <option value="">-- Select Pickup Point --</option>
                                        @foreach ($pickupopoints as $pickupopoint) 
                                                <option value="{{$pickupopoint->id}}">{{$pickupopoint->pickup_point_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('pickup_point_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label for="exampleInputEmail1">Purchase Price</label>
                                    <input type="text" class="form-control"  name="purchase_price" placeholder="Product Purchase Price" value="{{old('purchase_price')}}">
                                    @error('purchase_price')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="exampleInputEmail1">Selling Price</label>
                                    <input type="text" class="form-control"  name="selleing_price" placeholder="Product Selling Price" value="{{old('selleing_price')}}">
                                    @error('selleing_price')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="exampleInputEmail1">Discount Price</label>
                                    <input type="text" class="form-control"  name="discount_price" placeholder="Product Discount Price" value="{{old('discount_price')}}">
                                    @error('discount_price')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Unit</label>
                                    <input type="text" class="form-control" name="unit" placeholder="Product Unit" value="{{old('unit')}}">
                                    @error('unit')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Stock</label>
                                    <input type="text" class="form-control" name="stock_quantity" placeholder="Product Stock" value="{{old('stock_quantity')}}">
                                    @error('stock_quantity')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Color</label>
                                    <input type="text" class="form-control" name="color" placeholder="Product Color" value="" data-role="tagsinput">
                                    @error('color')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="exampleInputEmail1">Size</label>
                                    <input type="text" class="form-control" name="size" placeholder="Product Size" value="" data-role="tagsinput">
                                    @error('size')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Discription</label>
                                    <textarea name="description" id="summernote" cols="30" rows="10"></textarea>
                                    @error('description')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="exampleInputEmail1">Product Tags*</label>
                                    <input type="text" class="form-control" name="tags" placeholder="Product Tags" value="" data-role="tagsinput">
                                    @error('tags')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="exampleInputEmail1">Product Video </label>
                                    <input type="text" name="video" id="" class="form-control" placeholder="Product Video Embaded Link">
                                    @error('video')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                          </div>
                          
                          <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Product Infromation</h3>
                        </div>
                        <!-- /.card-header -->
                          <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="exampleInputEmail1">Product Thumbnail </label>
                                    <input type="file" name="thumbnail" id="" class="dropify" placeholder="Product ">
                                </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Product Image</h3>
                        </div>
                        <div class="card-body">
                            <table class="table" id="dynamic_add">
                                <tr>
                                    <td>
                                        <input type="file" accept="image/" name="image[]" multiple id="" class="form-control name_list">
                                    </td>
                                    <td>
                                        <p class="btn btn-info" id="add">Add</p>
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Featured Product</h3>
                        </div>
                        <div class="card-body">
                            <input type="checkbox" name="featured" data-bootstrap-switch data-on-color="success" data-off-color="danger" value="1">
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Todays Deals</h3>
                        </div>
                        <div class="card-body">
                            <input type="checkbox" name="todays_deals" data-bootstrap-switch data-on-color="success" data-off-color="danger" value="1" >
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Status</h3>
                        </div>
                        <div class="card-body">
                            <input type="checkbox" name="status" data-bootstrap-switch data-on-color="success" data-off-color="danger" value="1" >
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Cash On Delivery</h3>
                        </div>
                        <div class="card-body">
                            <input type="checkbox" name="cash_on_delivery" data-bootstrap-switch data-on-color="success" data-off-color="danger" value="1" >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
    <link rel="stylesheet" href="{{asset('backend/plugins/dropify/dropify.min.css')}}">
    <script src="{{asset('backend/plugins/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-tagsinput-latest/bootstrap-tagsinput.css')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-tagsinput-latest/bootstrap-tagsinput.min.js')}}"></script>
    
   
    
<script>
    $('#category_id').change(function (){
        let id = $(this).val();
        $.get('get/subcategory/'+id,function(data){
            $('#subcategory_id').html(data);
        })
    });
    $(document).on('change','#subcategory_id',function (){
        let id = $(this).val();
        $.get('get/child/'+id,function(data){
            $('#childcategory_id').html(data);
        })
    });
    $('.dropify').dropify();
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state',$(this).prop('checked'));
    });
    // var i=1;
    $('#add').click(function(){
        var i=1;
        i++;
        $('#dynamic_add').append('<tr id="row'+i+'"><td><input type="file" accept="image/" name="image[]" multiple id="" class="form-control name_list"></td><td><p class="btn btn-danger remove_btn" id="'+i+'">X</p></td></tr>');
    });
    $(document).on("click",'.remove_btn',function(){
        var btn_id = $(this).attr('id');
        // alert(btn_id);
        $('#row'+btn_id+'').remove();
    })
    
</script>

@endsection
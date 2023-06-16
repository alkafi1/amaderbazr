<form  method="POST" action="{{route('warehouse.update',$warehouse->id)}}" enctype="multipart/form-data">
  @csrf
<div class="modal-body">
  
      <div class="form-group">
        <label for="exampleInputEmail1">Warehouse Name</label>
        <input type="text" class="form-control"  name="name" value="{{$warehouse->name}}" >
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Warehouse Phone</label>
        <input type="text" class="form-control"  name="phone" value="{{$warehouse->phone}}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Wahrehouse Address</label>
        <input type="text" class="form-control" name="address" value="{{$warehouse->address}}">
      </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
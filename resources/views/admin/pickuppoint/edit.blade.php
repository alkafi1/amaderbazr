<form  method="POST" action="{{route('pickuppoint.update',$pickup_point->id)}}" id="update_form">
  @csrf
<div class="modal-body">
  
      <div class="form-group">
        <label for="exampleInputEmail1">Pickup Point Name</label>
        <input type="text" class="form-control"  name="pickup_point_name" value="{{$pickup_point->pickup_point_name}}" required>
      </div>
      <div class="form-group">
      <label for="exampleInputEmail1">Pickup Point Address</label>
        <input type="text" class="form-control"  name="pickup_point_address" value="{{$pickup_point->pickup_point_address}}" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Pickup Point Phone</label>
        <input type="text" class="form-control"  name="pickup_point_phone" value="{{$pickup_point->pickup_point_phone}}" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Pickup Point Phone <small>Optional*</small></label>
        <input type="text" class="form-control"  name="pickup_point_phone_two" value="{{$pickup_point->pickup_point_phone_two}}" >
        
      </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary cl" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary"><small class="loading d-none">....Lading</small> Update</button>
</div>
</form>
<script>
  //update coupon
  $("#update_form").submit(function(e){
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
                $('#update_form')[0].reset();
                $('#editModal').modal('hide');
                table.ajax.reload();
              }
            });
          });
</script>
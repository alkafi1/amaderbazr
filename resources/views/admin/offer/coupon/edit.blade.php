<form  method="POST" action="{{route('coupon.update',$coupon->id)}}" id="coupon_update">
  @csrf
<div class="modal-body">
  
      <div class="form-group">
        <label for="exampleInputEmail1">Coupon Code</label>
        <input type="text" class="form-control"  name="coupon_code" value="{{$coupon->coupon_code}}">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Valid Date</label>
        <input type="date" class="form-control"  name="valid_date" value="{{$coupon->valid_date}}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Type</label>
        <select name="type" id="" class="form-control">
          <option value="1" {{($coupon->type =='1'?'selected':'')}}>Percentage</option>
          <option value="2" {{($coupon->type =='2'?'selected':'')}}>Flat Amount</option>
        </select>
      </div>
      <div class="form-group">
      <label for="exampleInputEmail1">Coupo Amount</label>
        <input type="number" class="form-control"  name="coupon_amount" value="{{$coupon->coupon_amount}}">
      </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
<script>
  //update coupon
  $("#coupon_update").submit(function(e){
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
                $('#coupon_update')[0].reset();
                $('#editModal').modal('hide');
                table.ajax.reload();
              }
            });
          });
</script>
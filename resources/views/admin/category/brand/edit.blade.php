<form  method="POST" action="{{route('brand.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">

  <div class="form-group">
    <label for="exampleInputEmail1">Brand Name</label>
    <input type="text" class="form-control e_name"  name="name" value="{{$brand_info->name}}">
    <input type="hidden" class="form-control e_id"  name="id" value="{{$brand_info->id}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Brand Image</label>
    <img id="pic" width="100" class="float-right mt-2 e_image" src="{{asset('uploads/categories/brand')}}/{{$brand_info->image}}">
    <input type="file" class="form-control" name="image"  oninput="pic.src=window.URL.createObjectURL(this.files[0])">
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save And Changes</button>
  </div>
</div>
  </form>
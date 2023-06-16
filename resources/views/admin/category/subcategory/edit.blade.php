<form  method="POST" action="{{route('subcategory.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
<div class="form-group">
    <label for="exampleInputEmail1">Select Category</label>
    <select class="form-control" name="category_id" id="">
      <option value="">-- Select Category --</option>
      @foreach ($category_info as $key=>$category)
      <option value="{{$category->id}}" @if ($category->id == $subcategory_info->category_id )
        selected
      @endif>{{$category->name}}</option>
      @endforeach
      
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">SubCategory Name</label>
    <input type="text" class="form-control e_name"  name="name" value="{{$subcategory_info->subcategory_name}}">
    <input type="hidden" class="form-control e_id"  name="id" value="{{$subcategory_info->id}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">SubCategory Image</label>
    <img id="pic" width="100" class="float-right mt-2 e_image" src="{{asset('uploads/categories/subcategory')}}/{{$subcategory_info->image}}">
    <input type="file" class="form-control" name="image"  oninput="pic.src=window.URL.createObjectURL(this.files[0])">
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save And Changes</button>
  </div>
</div>
  </form>
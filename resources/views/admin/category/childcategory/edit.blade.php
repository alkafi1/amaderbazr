<form  method="POST" action="{{route('childcategory.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
<div class="form-group">
    <label for="exampleInputEmail1">Select Sub Category</label>
    <select class="form-control" name="subcategory_id" id="">
      <option value="">-- Select Category --</option>
      {{-- @foreach ($category_info as $key=>$category)
      <option value="{{$category->id}}" @if ($category->id == $subcategory_info->category_id )
        @php
          $subcategorie = App\Models\SubCategory::where('category_id',$category->id)->get();
        @endphp
         selected
      @endif>{{$category->name}}</option>
      @endforeach --}}
      @foreach ($category_info as $key=>$category)
        @php
          $subcategorie = App\Models\SubCategory::where('category_id',$category->id)->get();
        @endphp
        <option value="" class="text-bold">{{$category->name}}</option>
        @foreach ($subcategorie as $subcategory )
          <option value="{{$subcategory->id}}" @if ($subcategory->id == $chilcategory_info->subcategory_id)
            selected
          @endif>--- {{$subcategory->subcategory_name}}</option>
        @endforeach
      @endforeach
      
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">ChildCategory Name</label>
    <input type="text" class="form-control e_name"  name="name" value="{{$chilcategory_info->name}}">
    <input type="hidden" class="form-control e_id"  name="id" value="{{$chilcategory_info->id}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">SubCategory Image</label>
    <img id="pic" width="100" class="float-right mt-2 e_image" src="{{asset('uploads/categories/childcategory')}}/{{$chilcategory_info->image}}">
    <input type="file" class="form-control" name="image"  oninput="pic.src=window.URL.createObjectURL(this.files[0])">
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save And Changes</button>
  </div>
</div>
  </form>
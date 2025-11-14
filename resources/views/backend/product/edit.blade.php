@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.update',$product->id)}}">
        @csrf 
        @method('PATCH')
        
        <!-- Title -->
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$product->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- Summary -->
        <div class="form-group">
          <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- Description -->
        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- ✅ Box Contents -->
        <div class="form-group">
          <label for="boxcontent" class="col-form-label">Box Contents</label>
          <textarea class="form-control" id="boxcontent" name="boxcontent">{{$product->boxcontent}}</textarea>
          @error('boxcontent')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="row">
            <!-- Pre Order Notes -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="preorder" class="col-form-label">Pre Order Notes</label>
                    <textarea class="form-control" id="preorder" name="preorder">{{$product->preorder}}</textarea>
                    @error('preorder')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <!-- Standard Grade -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="standardgrade" class="col-form-label">Standard Grade</label>
                    <textarea class="form-control" id="standardgrade" name="standardgrade">{{$product->standardgrade}}</textarea>
                    @error('standardgrade')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Is Featured -->
        <div class="form-group">
          <label for="is_featured">Is Featured Pre-Order</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' {{ $product->is_featured ? 'checked' : '' }}> Yes                        
        </div>

        <div class="row">
            <!-- Category -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cat_id">Category <span class="text-danger">*</span></label>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="">--Select any category--</option>
                        @foreach($categories as $cat_data)
                            <option value='{{$cat_data->id}}' {{ $product->cat_id == $cat_data->id ? 'selected' : '' }}>{{$cat_data->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Brand -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" class="form-control">
                        <option value="">--Select Brand--</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Series -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="series_id">Series</label>
                    <select name="series_id" class="form-control">
                        <option value="">--Select Series--</option>
                        @foreach($series as $item)
                            <option value="{{$item->id}}" {{ $product->series_id == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Product Type -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="product_type_id">Product Type</label>
                    <select name="product_type_id" class="form-control">
                        <option value="">--Select Product Type--</option>
                        @foreach($producttype as $item)
                            <option value="{{$item->id}}" {{ $product->product_type_id == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Featured In -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="featuredin_id">Featured In</label>
                    <select name="featuredin_id" class="form-control">
                        <option value="">--Select Featured In--</option>
                        @foreach($featuredin as $item)
                            <option value="{{$item->id}}" {{ $product->featuredin_id == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Character -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="character_id">Character</label>
                    <select name="character_id" class="form-control">
                        <option value="">--Select Character--</option>
                        @foreach($character as $item)
                            <option value="{{$item->id}}" {{ $product->character_id == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Company -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="company_id">Company</label>
                    <select name="company_id" class="form-control">
                        <option value="">--Select Company--</option>
                        @foreach($company as $item)
                            <option value="{{$item->id}}" {{ $product->company_id == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Scale -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="scale_id">Scale</label>
                    <select name="scale_id" class="form-control">
                        <option value="">--Select Scale--</option>
                        @foreach($scale as $item)
                            <option value="{{$item->id}}" {{ $product->scale_id == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Size -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="size_id">Size</label>
                    <select name="size_id" class="form-control">
                        <option value="">--Select Size--</option>
                        @foreach($size as $item)
                            <option value="{{$item->id}}" {{ $product->size_id == $item->id ? 'selected' : '' }}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Price -->
        <div class="form-group">
          <label for="price" class="col-form-label">Price (NRS) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" value="{{$product->price}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- Discount -->
        <div class="form-group">
          <label for="discount" class="col-form-label">Discount (%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" value="{{$product->discount}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- Condition -->
        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default" {{ $product->condition=='default' ? 'selected' : '' }}>Default</option>
              <option value="new" {{ $product->condition=='new' ? 'selected' : '' }}>New</option>
              <option value="hot" {{ $product->condition=='hot' ? 'selected' : '' }}>Hot</option>
          </select>
        </div>

        <!-- Stock -->
        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" value="{{$product->stock}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- Photo -->
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fas fa-image"></i> Choose
                  </a>
              </span>
              <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
          </div>
          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- Status -->
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="active" {{ $product->status=='active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $product->status=='inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');
    $('#summary, #description, #boxcontent, #preorder, #standardgrade').summernote({
        placeholder: "Write here.....",
        tabsize: 2,
        height: 150
    });

    var child_cat_id = '{{$product->child_cat_id}}';
    $('#cat_id').change(function(){
        var cat_id = $(this).val();
        if(cat_id != null){
            $.ajax({
                url:"/admin/category/"+cat_id+"/child",
                type:"POST",
                data:{ _token:"{{csrf_token()}}" },
                success:function(response){
                    if(typeof(response)!='object'){
                        response=$.parseJSON(response);
                    }
                    var html_option="<option value=''>--Select any one--</option>";
                    if(response.status){
                        var data=response.data;
                        if(data){
                            $('#child_cat_div').removeClass('d-none');
                            $.each(data,function(id,title){
                                html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected' : '')+">"+title+"</option>";
                            });
                        }
                    } else {
                        $('#child_cat_div').addClass('d-none');
                    }
                    $('#child_cat_id').html(html_option);
                }
            });
        }
    });
    if(child_cat_id){
        $('#cat_id').change();
    }
</script>
@endpush

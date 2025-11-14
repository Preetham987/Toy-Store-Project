@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Product</h5>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="summary" class="col-form-label">Product Features <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
          @error('summary')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="boxcontent" class="col-form-label">Box Contents <span class="text-danger">*</span></label>
          <textarea class="form-control" id="boxcontent" name="boxcontent">{{old('boxcontent')}}</textarea>
          @error('boxcontent')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="preorder" class="col-form-label">Pre Order Notes <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="preorder" name="preorder">{{ old('preorder') }}</textarea>
                  @error('preorder')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
                  <label for="standardgrade" class="col-form-label">Standard Grade <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="standardgrade" name="standardgrade">{{ old('standardgrade') }}</textarea>
                  @error('standardgrade')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
      </div>

        <div class="form-group">
          <label for="is_featured">Is Featured Pre-Order</label><br>
          <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes                        
        </div>
        {{-- {{$categories}} --}}

        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label for="cat_id">Department <span class="text-danger">*</span></label>
                  <select name="cat_id" id="cat_id" class="form-control">
                      <option value="">--Select any category--</option>
                      @foreach($categories as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="brand_id">Brands <span class="text-danger">*</span></label>
                  <select name="brand_id" id="brand_id" class="form-control">
                      <option value="">--Select any brand--</option>
                      @foreach($brands as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="series_id">Series <span class="text-danger">*</span></label>
                  <select name="series_id" id="series_id" class="form-control">
                      <option value="">--Select any series--</option>
                      @foreach($series as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="product_type_id">Product Type <span class="text-danger">*</span></label>
                  <select name="product_type_id" id="product_type_id" class="form-control">
                      <option value="">--Select any product type--</option>
                      @foreach($producttype as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="featuredin_id">Featured In <span class="text-danger">*</span></label>
                  <select name="featuredin_id" id="featuredin_id" class="form-control">
                      <option value="">--Select any featured in--</option>
                      @foreach($featuredin as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="character_id">Character <span class="text-danger">*</span></label>
                  <select name="character_id" id="character_id" class="form-control">
                      <option value="">--Select any character--</option>
                      @foreach($character as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="company_id">Company <span class="text-danger">*</span></label>
                  <select name="company_id" id="company_id" class="form-control">
                      <option value="">--Select any company--</option>
                      @foreach($company as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="scale_id">Scale <span class="text-danger">*</span></label>
                  <select name="scale_id" id="scale_id" class="form-control">
                      <option value="">--Select any scale--</option>
                      @foreach($scale as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group">
                  <label for="size_id">Size <span class="text-danger">*</span></label>
                  <select name="size_id" id="size_id" class="form-control">
                      <option value="">--Select any size--</option>
                      @foreach($size as $key=>$cat_data)
                          <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
      </div>

        <!-- <div class="form-group d-none" id="child_cat_div">
          <label for="child_cat_id">Sub Category</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Select any category--</option>
              {{-- @foreach($parent_cats as $key=>$parent_cat)
                  <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
              @endforeach --}}
          </select>
        </div> -->

        <div class="form-group">
          <label for="price" class="col-form-label">Price(INR) <span class="text-danger">*</span></label>
          <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
          @error('price')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="discount" class="col-form-label">Discount(%)</label>
          <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{old('discount')}}" class="form-control">
          @error('discount')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <!-- <div class="form-group">
          <label for="size">Size</label>
          <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--Select any size--</option>
              <option value="S">Small (S)</option>
              <option value="M">Medium (M)</option>
              <option value="L">Large (L)</option>
              <option value="XL">Extra Large (XL)</option>
          </select>
        </div> -->

        <!-- <div class="form-group">
          <label for="brand_id">Brand</label>
          {{-- {{$brands}} --}}

          <select name="brand_id" class="form-control">
              <option value="">--Select Brand--</option>
             @foreach($brands as $brand)
              <option value="{{$brand->id}}">{{$brand->title}}</option>
             @endforeach
          </select>
        </div> -->

        <div class="form-group">
          <label for="condition">Condition</label>
          <select name="condition" class="form-control">
              <option value="">--Select Condition--</option>
              <option value="default">Default</option>
              <option value="new">New</option>
              <option value="hot">Hot</option>
          </select>
        </div>

        <div class="form-group">
          <label for="stock">Quantity <span class="text-danger">*</span></label>
          <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{old('stock')}}" class="form-control">
          @error('stock')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}" multiple>
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
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

    $('#lfm').on('click', function () {
      var input = $('#thumbnail');
      var holder = $('#holder');

      // When an image is selected
      window.SetUrl = function (items) {
          var urls = items.map(function (item) {
              return item.url;
          });

          urls.forEach(function (url) {
              // Append URLs separated by commas
              input.val(function (i, val) {
                  return val ? val + ',' + url : url;
              });

              // Show previews
              holder.append('<img src="' + url + '" style="height: 100px; margin: 5px;">');
          });
      };
  });

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description in points.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    $(document).ready(function() {
      $('#boxcontent').summernote({
        placeholder: "Write detail description in points.....",
          tabsize: 2,
          height: 100
      });
    });
    $(document).ready(function() {
      $('#preorder').summernote({
        placeholder: "Write detail description in points.....",
          tabsize: 2,
          height: 100
      });
    });
    $(document).ready(function() {
      $('#standardgrade').summernote({
        placeholder: "Write detail description in points.....",
          tabsize: 2,
          height: 100
      });
    });
    // $('select').selectpicker();

</script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Select sub category----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })
</script>
@endpush

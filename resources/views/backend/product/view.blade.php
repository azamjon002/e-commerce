@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add Product</h2>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{route('product.store')}}" method="post">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Title" name="title"
                                                   value="{{old('title')}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="summary">Summary <span class="text-danger">*</span></label>
                                            <textarea id="summary" type="text" class="form-control" placeholder="Some summary text.. "
                                                      name="summary">{{old('summary')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea id="description" type="text" class="form-control" placeholder="Some description text.. "
                                                      name="description">{{old('description')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="stock">Stock <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="Stock" value="{{old('stock')}}" name="stock">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Price <span class="text-danger">*</span></label>
                                            <input type="number" step="any" class="form-control" placeholder="Price" value="{{old('price')}}" name="price">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Discount</label>
                                            <input type="number" step="any" class="form-control" placeholder="Discount" value="{{old('discount')}}" name="discount">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Image</label>
                                            <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                                <input type="" class="form-control" id="thumbnail" name="photo">
                                            </div>
                                            <div id="holder" style="margin-top: 15px; max-height: 100px"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <label for="">Brands</label>
                                        <select class="form-control show-tick" name="brand_id">
                                            <option value="">-- Brands --</option>
                                            @foreach(\App\Models\Brand::get() as $brand)
                                                <option value="{{$brand->id}}">{{$brand->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <label for="">Categories</label>
                                        <select class="form-control show-tick" name="cat_id" id="cat_id">
                                            <option value="">-- Categories --</option>
                                            @foreach(\App\Models\Category::where('is_parent', 1)->get() as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-sm-12 d-none" id="child_cat_div">
                                        <label for="">Child Categories</label>
                                        <select class="form-control show-tick" id="child_cat_id" name="child_cat_id">

                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <label for="">Vendor</label>
                                        <select class="form-control show-tick" name="vendor_id">
                                            <option value="">-- Vendor --</option>
                                            @foreach(\App\Models\User::where('role', 'vendor')->get() as $user)
                                                <option value="{{$user->id}}">{{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <label for="">Size</label>
                                        <select class="form-control show-tick" name="size">
                                            <option value="">-- Size --</option>
                                            <option value="X" {{old('size') == 'X' ? 'selected' : ''}}>Small</option>
                                            <option value="L" {{old('size') == 'M' ? 'selected' : ''}}>Medium</option>
                                            <option value="M" {{old('size') == 'L' ? 'selected' : ''}}>Large</option>
                                            <option value="XL" {{old('size') == 'XL' ? 'selected' : ''}}>Extra Large</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <label for="">Conditions</label>
                                        <select class="form-control show-tick" name="conditions">
                                            <option value="">-- Conditions --</option>
                                            <option value="new" {{old('conditions') == 'new' ? 'selected' : ''}}>New</option>
                                            <option value="popular" {{old('conditions') == 'popular' ? 'selected' : ''}}>Popular</option>
                                            <option value="winter" {{old('conditions') == 'winter' ? 'selected' : ''}}>Winter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $('#lfm').filemanager('image');

        $(document).ready(function() {
            $('#description').summernote();
        });

        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>

    <script>
        $('#cat_id').change(function () {
            var cat_id = $(this).val();
            if(cat_id != null){
                $.ajax({
                    url:"category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}",
                        cat_id: cat_id,
                    },
                    success:function (response){
                        var html_option = "<option value=''>-- Child Category --</option>"
                        if(response.status){
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function (id, title){
                                html_option += "<option value='"+id+"'>"+title+"</option>";
                            })
                            $('#child_cat_id').html(html_option);
                        }else {
                            $('#child_cat_div').addClass('d-none')
                            alert("No Child Category !!!")
                        }
                    }
                })
            }
        })

    </script>


@endsection

@extends('backend.layouts.master')

@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Add Category</h2>
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
                            <form action="{{route('category.store')}}" method="post">
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
                                            <label for="description">Summary</label>
                                            <textarea id="description" type="text" class="form-control" placeholder="Write some words... "
                                                      name="summary">{{old('summary')}}</textarea>
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
                                        <label for="">Is Parent <span class="text-danger">*</span> :</label>
                                        <input id="is_parent" name="is_parent" type="checkbox" value="1" checked >  Yes
                                    </div>

                                    <div class="col-lg-12 col-sm-12 d-none" id="parent_cat_div">
                                        <label for="">Parent Category</label>
                                        <select class="form-control show-tick" name="parent_id">
                                            <option value="">-- Parent Category --</option>
                                            @foreach($parent_cats as $pcat)
                                                <option value="{{$pcat->id}}">{{$pcat->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-12 col-sm-12">
                                        <select class="form-control show-tick" name="status">
                                            <option value="">-- Status --</option>
                                            <option value="active" {{old('status') == 'active' ? 'selected' : ''}}>Active
                                            </option>
                                            <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}}>
                                                Inactive
                                            </option>
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

        $('#is_parent').change(function (e) {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            if(is_checked){
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            }else {
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>
@endsection

@extends('backend.layouts.master')
@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="float-left"><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Products</h2>
                        <a href="{{route('product.create')}}" class="btn btn-sm btn-outline-primary float-right">
                            <i class="icon-plus"> </i>
                            Create Product
                        </a>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    @include('backend.layouts.natification')
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Offer Price</th>
                                        <th>Discount</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                        <th>Conditions</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>
                                                <img src="{{$item->photo}}" alt="" width="90" height="70">
                                            </td>
                                            <td>${{number_format($item->price,2)}}</td>
                                            <td>${{number_format($item->offer_price,2)}}</td>
                                            <td>{{$item->offer_price}}%</td>
                                            <td>{{$item->size}}</td>
                                            <td>
                                                <input type="checkbox" name="toggle" value="{{$item->id}}" {{$item->status == 'active' ? 'checked':''}} data-toggle="toggle" data-on="active" data-off="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                            </td>
                                            <td>
                                                @if($item->conditions == 'new')
                                                    <span class="badge badge-success">New</span>
                                                @elseif($item->conditions == 'popular')
                                                    <span class="badge badge-primary">Popular</span>
                                                @else
                                                    <span class="badge badge-warning">Winter</span>
                                                @endif
                                            </td>
                                            <td class="d-flex pt-4">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#productID{{$item->id}}" data-toggle="tooltip" title="view" data-placement="bottom" class="btn btn-sm btn-outline-primary mr-1"><i class="fas fa-eye"></i></a>
                                                <a href="{{route('product.edit', $item->id)}}" data-toggle="tooltip" title="edit" data-placement="bottom" class="btn btn-sm btn-outline-warning mr-1"><i class="fas fa-edit"></i></a>
                                                <form class="" action="{{route('product.destroy', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a  data-toggle="tooltip" title="delete" data-id="{{$item->id}}" data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                            </td>
                                            <div class="modal fade" id="productID{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    @php
                                                        $product = \App\Models\Product::where('id', $item->id)->first();
                                                    @endphp
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">{{\Illuminate\Support\Str::upper($product->title)}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <strong>Summary:</strong>
                                                            <p style="margin: 0px; padding-bottom:10px ">{!! html_entity_decode($product->summary) !!}</p>
                                                            <strong>Description:</strong>
                                                            <p style="margin: 0px; padding-bottom:10px ">{!! html_entity_decode($product->description) !!}</p>
                                                            <strong>Price:</strong>
                                                            <p style="margin: 0px; padding-bottom:10px ">{!! html_entity_decode($product->price,2) !!}</p>
                                                            <strong>Offer Price:</strong>
                                                            <p style="margin: 0px; padding-bottom:10px ">{!! html_entity_decode($product->offer_price,2) !!}</p>
                                                            <strong>Discount:</strong>
                                                            <p style="margin: 0px; padding-bottom:10px ">{!! html_entity_decode($product->discount) !!}%</p>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong>Category:</strong>
                                                                    <p style="margin: 0px; padding-bottom:10px ">{{\App\Models\Category::where('id', $product->cat_id)->value('title')}}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Child Category</strong>
                                                                    <p style="margin: 0px; padding-bottom:10px ">{{\App\Models\Category::where('id', $product->child_cat_id)->value('title')}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <strong>Brand:</strong>
                                                                    <p style="margin: 0px; padding-bottom:10px ">{{\App\Models\Brand::where('id', $product->brand_id)->value('title')}}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Size:</strong>
                                                                    <p style="margin: 0px;" class="badge badge-success">  {{$product->size}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong>Conditions:</strong>
                                                                    <p style="margin: 0px" class="badge badge-warning">{{$product->conditions}}</p>                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Status:</strong>
                                                                    <p style="margin: 0px" class="badge badge-danger">{{$product->status}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function (e){
            var form = $(this).closest('form')
            var dataId  = $(this).data('id');
            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your data has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your data is safe!");
                    }
                });
        })
    </script>
    <script>
        $('input[name=toggle]').change(function (){
            var mode = $(this).prop('checked');
            var id = $(this).val();

            $.ajax({
                'url':'{{route('product.status')}}',
                'type':'POST',
                'data':{
                    _token: '{{csrf_token()}}',
                    mode: mode,
                    id:id
                },
                success:function (response) {
                    if(response.status){
                        alert(response.msg)
                    }else {
                        alert('Please try again!')
                    }
                }
            })
        })
    </script>
@endsection

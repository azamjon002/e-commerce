@extends('backend.layouts.master')
@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="float-left"><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Banners</h2>
                        <a href="{{route('banner.create')}}" class="btn btn-sm btn-outline-primary float-right">
                            <i class="icon-plus"> </i>
                            Create Banner
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
                                        <th>Description</th>
                                        <th>Photo</th>
                                        <th>Condition</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>
                                                <img src="{{$item->photo}}" alt="" width="90" height="70">
                                            </td>
                                            <td>
                                                @if($item->condition == 'banner')
                                                    <span class="badge badge-success">Banner</span>
                                                @else
                                                    <span class="badge badge-primary">Promotive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" name="toggle" value="{{$item->id}}" {{$item->status == 'active' ? 'checked':''}} data-toggle="toggle" data-on="active" data-off="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                            </td>
                                            <td>
                                                <a href="{{route('banner.edit', $item->id)}}" data-toggle="tooltip" title="edit" data-placement="bottom" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                                <form class="float-right" action="{{route('banner.destroy', $item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a  data-toggle="tooltip" title="delete" data-id="{{$item->id}}" data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                            </td>
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
                'url':'{{route('banner.status')}}',
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

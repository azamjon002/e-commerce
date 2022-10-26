
<!-- Javascript -->
<script src="{{asset('admin/assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('admin/assets/bundles/vendorscripts.bundle.js')}}"></script>

{{--Summernote--}}
<script src="{{asset('admin/assets/summernote/summernote.js')}}"></script>

<script src="{{asset('admin/assets/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{asset('admin/assets/bundles/morrisscripts.bundle.js')}}"></script>
<script src="{{asset('admin/assets/bundles/knob.bundle.js')}}"></script>
<script src="{{asset('admin/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/ui/sortable-nestable.js')}}"></script>
<script src="{{asset('admin/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('admin/assets/js/index.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@yield('scripts')

<script>
    setTimeout(function (){
        $('#alert').slideUp();
    },3000);
</script>

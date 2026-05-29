 <!-- Jquery Core Js -->
    <script src="{{ asset('public/admin/assets/bundles/libscripts.bundle.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <!-- Plugin Js -->
    <script src="{{ asset('public/admin/assets/bundles/apexcharts.bundle.js')}}"></script>
    <script src="{{ asset('public/admin/assets/bundles/dataTables.bundle.js')}}"></script>  

    <!-- Jquery Page Js -->
    <script src="{{ asset('public/admin/js/template.js')}}"></script>
    {{-- <script src="{{ asset('public/admin/js/page/index.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

    <script>
        $('#myDataTable')
        .addClass( 'nowrap')
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
        setTimeout(function () {
            $('.alert-success').fadeOut('slow');
        }, 3000);
    </script>
 <!-- Jquery Core Js -->
    <script src="{{ asset('public/admin/assets/bundles/libscripts.bundle.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <!-- Plugin Js -->
    <script src="{{ asset('public/admin/assets/bundles/apexcharts.bundle.js')}}"></script>
    <script src="{{ asset('public/admin/assets/bundles/dataTables.bundle.js')}}"></script>  

    <!-- Jquery Page Js -->
    <script src="{{ asset('public/admin/js/template.js')}}"></script>
    <script src="{{ asset('public/admin/js/page/index.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&amp;callback=myMap"></script>  
    <script>
        $('#myDataTable')
        .addClass( 'nowrap')
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });

    </script>
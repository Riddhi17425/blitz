<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

<!-- plugin css file  -->

<link rel="stylesheet" href="{{ asset('public/admin/assets/plugin/datatables/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{ asset('public/admin/assets/plugin/datatables/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- project css file  -->
<link rel="stylesheet" href="{{ asset('public/admin/assets/css/ebazar.style.min.css') }}"> 
<style>
:root,
[data-bs-theme="light"],
#ebazar-layout.theme-blue {
  --primary-color: #001f3f;
  --secondary-color: #e21212;
  --secondary-rgb: 139, 0, 0;
  --bs-primary: #001f3f;
  --bs-primary-rgb: 0, 31, 63;
  --bs-link-color: #001f3f;
  --bs-link-color-rgb: 0, 31, 63;
  --bs-link-hover-color: #e21212;
  --bs-link-hover-color-rgb: 139, 0, 0;
  --bs-primary-text-emphasis: #00152b;
  --bs-primary-bg-subtle: #d9e6f2;
  --bs-primary-border-subtle: #8aa8c6;
}

.btn-primary {
    --bs-btn-bg: #001f3f;
    --bs-btn-border-color: #001f3f;
    --bs-btn-hover-bg: #e21212;
    --bs-btn-hover-border-color: #e21212;
    --bs-btn-active-bg: #00152b;
    --bs-btn-active-border-color: #00152b;
    --bs-btn-disabled-bg: #001f3f;
    --bs-btn-disabled-border-color: #001f3f;
}

.btn-outline-primary {
    --bs-btn-color: #001f3f;
    --bs-btn-border-color: #001f3f;
    --bs-btn-hover-bg: #e21212;
    --bs-btn-hover-border-color: #e21212;
    --bs-btn-active-bg: #00152b;
    --bs-btn-active-border-color: #00152b;
}

.sidebar .menu-list .m-link:hover,
.sidebar .menu-list .ms-link:hover,
.dropdown-item:hover,
.dropdown-item:focus {
    color: #fff !important;
    background-color: #e21212 !important;
}

.text-primary {
    color: #001f3f !important;
}

.bg-primary {
    background-color: #001f3f !important;
}

.border-primary {
    border-color: #001f3f !important;
}

.error{
  color:red;
}
/* Datatable pagination styling fix */
.pagination .page-item .page-link {
    color: #001f3f !important;
    background-color: #fff !important;
    border: 1px solid #dee2e6 !important;
}
.pagination .page-item.active .page-link {
    color: #fff !important;
    background-color: #001f3f !important;
    border-color: #001f3f !important;
}
.pagination .page-item.disabled .page-link {
    color: #6c757d !important;
    background-color: #fff !important;
    border-color: #dee2e6 !important;
}
.loader-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.8); /* semi-transparent */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999; /* on top of everything */
}

/* Loader */
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Animation */
@-webkit-keyframes spin { 
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

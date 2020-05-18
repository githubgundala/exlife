<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>exlife</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('template/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('template/dist/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- select2 --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" type="text/css" rel="stylesheet" />
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ url('template//plugins/ekko-lightbox/ekko-lightbox.css') }}">
</head>
<body class="sidebar-mini control-sidebar-slide-open accent-teal">
<!-- Site wrapper -->
<div class="wrapper ">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-teal">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @if (session('alertstatus') == TRUE)
      <div class="alert {{ session('tipe') }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5>{{ session('message') }}</h5>
      </div>
      @endif
      <div class="container-fluid">
        <div class="row mb-2">
          {{-- <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>&copy; <a href="http://adminlte.io">exlife.id</a></strong> 
  </footer>

  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('template/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ url('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ url('template/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ url('template/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ url('template/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('template/dist/js/demo.js') }}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('template/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{ url('template/dist/js/demo.js')}}"></script>
{{-- <script src="{{ url('template/dist/js/pages/dashboard3.js')}}"></script> --}}
{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- Ekko Lightbox -->
<script src="{{ url('template/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ url('template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
  // csrf
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  // select2
  $('.select2').select2({ 
    theme: "bootstrap",
    placeholder: "Pilih..."
  });
});
</script>
@stack('script')
</body>
</html>
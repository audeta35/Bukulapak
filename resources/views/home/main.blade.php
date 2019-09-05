<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
</head>
<body class="sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

      <ul class="navbar-nav mr-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link"><i class="fas fa-phone mr-2"></i> 085923417894</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link"><i class="fas fa-envelope mr-2"></i> audeta35@gmail.com</a>
        </li>
      </ul>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="#">Buku</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="#">Alat Tulis</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="#">Lainnya</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="#">Bantuan</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <nav class="navbar navbar-expand navbar-dark navbar-dark">
    <div class="container">
      <ul class="navbar-nav">
        <a class="navbar-brand" href="#">
          <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
          <b class="ml-2 h4">{{config('app.name')}}</b>
        </a>
      </ul>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          @if (Route::has('login'))
            @auth
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-user fa-fw fa-sm"></i>
                  {{Auth::user()->email}}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">Halo {{Auth::user()->name}}</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                    <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-shopping-basket mr-2"></i> Status Pembelian
                    <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-user-cog mr-2"></i> Profile
                    <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                    <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                </div>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                  <i class="fas fa-fw fa-sm fa-sign-in-alt"></i> Login
                </a>
              </li>

              @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">
                    <i class="fas fa-fw fa-sm fa-user-plus"></i> Register
                  </a>
                </li>
              @endif
            @endauth
          @endif
        </ul>
      </div>

    </div>
  </nav>
  <!-- /.navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container">
      @yield('content');
    </div>
  </div>

</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('admin/plugins/inputmask/jquery.inputmask.bundle.js')}}"></script>
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/plugins/fastclick/fastclick.js')}}"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('#kotaTujuan').select2({
      placeholder: "Pilih kota...",
      allowClear: true
    })

    $('#kurir').select2({
      placeholder: "Pilih kurir...",
      allowClear: true
    })
  })
</script>
</body>
</html>

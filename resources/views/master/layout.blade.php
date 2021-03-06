<!DOCTYPE html>
<html lang="en" height="" 100%>

<head>
    <meta charset="utf-8"/>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="icon" sizes="76x76" href="{{asset('assets/img/nevada-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/nevada-icon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Nevada - @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="{{'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons'}}"/>
    <link rel="stylesheet" href="{{'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css'}}">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet"/>

    <link href="{{asset('css/jquery.dataTables.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{asset('css/jquery.dataTables.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
{!! Html::script('js/jquery.js') !!}
{!! Html::script('js/jquery.dataTables.min.js') !!}
{!! Html::script('js/plugins/data-tables/data-tables-script.js') !!}

<body style="position:relative; min-height:100%">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="/dashboardAdmin" class="simple-text logo-normal">
                <img src="{{asset('assets/img/nevada.png')}}" width="180" height="75">
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                @can('user')
                    <li class="nav-item active  ">
                        <a class="nav-link" href="{{route('dashboardUser.index')}}">
                            <i class="material-icons">dashboard</i>
                            <p>Beranda User</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('OrderReq.index')}}">
                            <i class="material-icons">content_paste</i>
                            <p>Pesanan <span style="margin-left: 45%;color: #7f231c"><strong>1</strong></span></p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('OrderReq.history')}}">
                            <i class="material-icons">history</i>
                            <p>History Pesanan</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('Wishlist.index')}}">
                            <i class="material-icons">favorite_border</i>
                            <p>Wishlist</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('produkUser.index')}}">
                            <i class="material-icons">cancel_presentation</i>
                            <p>Produk Habis</p>
                        </a>
                    </li>
                @endcan
                @can('admin')
                    <li class="nav-item active  ">
                        <a class="nav-link" href="{{route('dashboardAdmin.index')}}">
                            <i class="material-icons">dashboard</i>
                            <p>Beranda Admin</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('user.index')}}">
                            <i class="material-icons">person</i>
                            <p>Data Customer</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('produk.index')}}">
                            <i class="material-icons">note_add</i>
                            <p>Tambah Produk</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('produk.listProduk')}}">
                            <i class="material-icons">library_books</i>
                            <p>List Produk</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('OrderProses.index')}}">
                            <i class="material-icons">content_paste</i>
                            <p>Pesanan <span style="margin-left: 45%;color: #7f231c"><strong>1</strong></span></p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('produk.emProduk')}}">
                            <i class="material-icons">cancel_presentation</i>
                            <p>Produk Habis</p>
                        </a>
                    </li>
            @endcan
            <!-- <li class="nav-item active-pro ">
                      <a class="nav-link" href="./upgrade.html">
                          <i class="material-icons">unarchive</i>
                          <p>Upgrade to PRO</p>
                      </a>
                  </li> -->
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <p class="navbar-brand" style="font-size: 30px; margin-top: 10%"><strong>@yield('subtitle')</strong>
                    </p>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    {!! Form::open(['url'=>route('Search.index'), 'method'=>'get', 'class' => 'navbar-form']) !!}
                    <div class="input-group no-border">
                        <input type="text" name="cari" class="form-control" placeholder="cari produk di sini...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                    {!! Form::close() !!}
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="material-icons">dashboard</i>
                                <p class="d-lg-none d-md-block">
                                    Stats
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Cart.index')}}">
                                <i class="material-icons">shopping_cart</i>
                                <span class="notification">5</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                                <div class="ripple-container"></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                @can('user')
                                    <p class="dropdown-header" style="margin-top: 10px">{{Auth::user()->name}}</p>
                                @endcan
                                @can('admin')
                                    <p class="dropdown-header" style="margin-top: 10px">Hi Admin!</p>
                                @endcan
                                <hr>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                    <i class="material-icons" style="position: initial">logout</i><span>
                                            <p class="dropdown-item">Logout</p></span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-none center">
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com/license">
                                ABOUT
                            </a>
                        </li>
                    </ul>
                    Nevada &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    , made with <i class="material-icons" style="font-size: 13px">favorite</i> by
                    <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>. ALL Right Reserved.
                </nav>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<script src="{{'https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'}}"></script>
<!-- Chartist JS -->
<script src="{{asset('assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/material-dashboard.min.js?v=2.1.0')}}" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/demo/demo.js')}}"></script>
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });
</script>
@yield('script')
</body>

</html>

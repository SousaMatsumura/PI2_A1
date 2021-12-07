<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @auth
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/brasao_caragua.png') }}" alt="" class="img-fluid">
                </div>
                <div class="sidebar-brand-text mx-3 text-left">SEDUC ALIMENTAÇÃo</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @includeWhen(auth()->user()->isSchool(), 'school.partials.sidebar')
            @includeWhen(auth()->user()->isSecretary(), 'secretary.partials.sidebar')

            <hr class="sidebar-divider">

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POSt">
                    @csrf
                    <button class="nav-link bg-transparent border-0">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Sair</span>
                    </button>
                </form>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        @endauth

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column @guest bg-white @endguest">

            <!-- Main Content -->
            <div id="content">
                
                @include('layouts.partials.navbar')
                

                <div class="container-fluid">

                    @if(session()->has('alert'))

                        <div class="alert bg-{{ session('alert')['type'] }} alert-dismissible fade show text-white" role="alert">
                            <strong><i class="fa fa-fw fa-{{ session('alert')['icon'] }}"></i></strong> {!! session('alert')['message'] !!}
                            @if(session()->has('list'))
                                <ul>
                                    @foreach(session('list')['elements'] as $element)
                                        <li>{{ $element }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif


                    @auth
                        <div class="row align-items-center my-4">
                            <div class="col-md">
                                <h1 class="h3 m-0 text-gray-800">@yield('title')</h1>
                            </div>
                            @hasSection('options')
                                <div class="col-md-6 text-right">
                                    @yield('options')
                                </div>
                            @endif
                        </div>
                    @endauth

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer ">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @auth
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @endauth

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @stack('js')

</body>

</html>
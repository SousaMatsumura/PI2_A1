<!-- Topbar -->
<nav class="navbar navbar-expand @guest bg-primary navbar-dark @else bg-white navbar-light mb-4 @endguest topbar static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    @guest
        <a href="" class="navbar-brand">
            {{ config('app.name') }}
        </a>
    @endguest

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item text-right">
            @guest

                <span class="mr-2 d-none d-lg-inline text-white text-right">
                    Você ainda não se identificou
                </span>

            @else

                <span class="d-none d-lg-inline text-gray-600 small text-right">
                    {{ auth()->user()->name }}<br>
                    {{ auth()->user()->institution->name }}
                </span>

            @endguest
           
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
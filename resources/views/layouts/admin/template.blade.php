<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Booking Hotel</title>

    {{-- @include('layouts.admin.css') --}}

    @include('layouts.admin.css')
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline ml-auto">
                    <ul class="navbar-nav navbar-right">
                        {{-- <ul class="navbar-nav"> --}}
                        {{-- </ul> --}}
                        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                                @if (Auth::user())
                                    {{ Auth::user()->name }}
                                @else
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                @if (Auth::user())
                                    <div class="dropdown-divider"></div>
                                    {{-- <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a> --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button class="dropdown-item has-icon text-danger" :href="route('logout')"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('registercustomor') }}" class="dropdown-item has-icon">
                                        <i class="far fa-user"></i> Register
                                    </a>
                                    <a href="/login/view" class="dropdown-item has-icon">
                                        <i class="fas fa-bolt"></i> Login
                                    </a>
                                @endif


                            </div>
                        </li>
                    </ul>
                </form>
            </nav>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg mt-2"><i
                        class="fas fa-bars"></i></a>
            </nav>
            @include('layouts.admin.sidebar')

            <!-- Main Content -->
            {{-- <div class="main-content"> --}}

            @include('layouts.admin.footer')
        </div>
    </div>

    @include('layouts.admin.script')
</body>

</html>

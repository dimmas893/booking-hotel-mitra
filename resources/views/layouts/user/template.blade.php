<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Booking</title>

    @include('layouts.user.css')
    <link rel="stylesheet" href="{{ asset('assets/modules/ionicons/css/ionicons.min.css') }}">
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
    <style>
        dimmas {
            z-index: 999999;
            position: -webkit-sticky;
            position: sticky;
            position: fixed;
            top: 0;
            left: 0;
            height: 69px;
            width: 100%;
            /* background: linear-gradient(to bottom, #b4ddf3, rgba(145, 220, 255, 0.2) 70%, #63bef700); */
            /* background when scroll is in the top */
            transition: background .5s;
            /* control how smooth the background changes */
        }

        dimmas.scrolled {
            background: rgb(12, 137, 247);
        }

        main {
            height: 200vh;
        }
    </style>
</head>
<div class="d-sm-none">
    <style>
        body.layout-3 .main-content {
            padding-left: 0;
            padding-right: 0;
            padding-top: 170px;
        }
    </style>

    <body class="layout-3">

</div>
<div class="d-none d-xl-block d-lg-block d-md-block">
    <style>
        body.layout-3 .main-content {
            padding-left: 0;
            padding-right: 0;
            padding-top: 125px;
        }
    </style>

    <body class="layout-3">
</div>

{{-- <body class="layout-3"> --}}
<div id="app">
    <div class="main-wrapper container">
        <div class="navbar-bg"></div>

        <dimmas>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="{{ route('welcome') }}" class="navbar-brand" style="text-transform: lowercase;">byurbyur<i
                        class="fa fa-globe" style="color:yellow; font-size:1em;"></i>COM</a>
                <form class="form-inline mr-auto">
                    <div class="search-element">
                        <input class="form-control searchname" id="" type="search" placeholder="Search"
                            aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        <div class="search-backdrop"></div>
                        <div class="search-result">
                            <div class="search-header mb-2">
                                Pencarian
                            </div>

                            {{ csrf_field() }}
                            <div id="data"></div>
                            <div class="search-header">
                                Pencarian terpopuler
                            </div>
                            @php
                                $pencarian = \App\Models\Mitra::get()->take(3);
                            @endphp
                            @foreach ($pencarian as $item)
                                @php
                                    $search = \App\Models\Pencarian::where('mitra_id', $item->id)->first();
                                    if ($search != null) {
                                        $ser = $search->pencarian;
                                    } else {
                                        $ser = 0;
                                    }
                                @endphp
                                <div class="search-item">
                                    <a href="{{ route('detailmitra', $item->id) }}">
                                        <img class="mr-3 rounded" width="30"
                                            src="{{ asset('mitrafoto/' . $item->foto) }}" alt="product">
                                        {{ $item->namamitra }} - {{ $item->alamatmitralengkap }} ( dicari
                                        {{ $ser }}x )
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    @if (Auth::user())
                        <li class="dropdown dropdown-list-toggle"><a href="{{ route('cekpesananview') }}"
                                class="nav-link nav-link-lg beep">{{ \App\Models\Booking::where('id_user', Auth::user()->id)->where('status', 'unpaid')->count() }}
                                <i class="ion-ios-cart-outline"></i></a>

                        </li>
                        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link nav-link-lg nav-link-user">
                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                    class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form action="{{ route('logoutaplikasi') }}" method="post">
                                    @csrf
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item has-icon text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link nav-link-lg nav-link-user">
                                <i class="fas fa-bars"></i>
                                <div class="d-sm-none d-lg-inline-block"></div>
                                {{-- <img alt="image" src={{'assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> --}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('registercustomor') }}" class="dropdown-item has-icon">
                                    <i class="fas fa-bolt"></i> Register
                                </a>
                                <a href="{{ route('login') }}" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i> Login
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>
            </nav>
        </dimmas>

        @yield('contents')
        @include('layouts.user.footer')
    </div>
</div>

@include('layouts.user.script')
{{-- <script>
    $(document).ready(function() {
        $('#pecarianshow').hide();
        $('.pecarian').keyup(function() {
            var pecarian = $('.pecarian').val();
            if (pecarian != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('autocomplete.search.query') }}",
                    data: {
                        'name': pecarian,
                        '_token': _token,
                    },
                    success: function(response) {
                        $('#pecarianshow').fadeIn();
                        $('#datapecarian').html(response);
                    }
                });
            } else {
                $('#pecarianshow').fadeOut();
            }
        });
    });
</script> --}}

<script>
    $(function() {
        $(document).ready(function() {
            $('#show_data_table').hide();
            $('.searchname').keyup(function() {
                var searchname = $('.searchname').val();
                if (searchname != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        type: 'post',
                        url: "{{ route('autocomplete.search.query') }}",
                        data: {
                            'name': searchname,
                            '_token': _token,
                        },
                        success: function(response) {
                            $('#show_data_table').fadeIn();
                            $('#data').html(response);
                        }
                    });
                } else {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        type: 'post',
                        url: "{{ route('autocomplete.search.query') }}",
                        data: {
                            '_token': _token,
                        },
                        success: function(response) {
                            $('#show_data_table').fadeIn();
                            $('#data').html(response);
                        }
                    });
                }
            });
        });


        TU_all()

        function TU_all() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: 'post',
                url: "{{ route('autocomplete.search.query') }}",
                data: {
                    '_token': _token,
                },
                success: function(response) {
                    $('#show_data_table').fadeIn();
                    $('#data').html('');
                }
            });
        }
    });
    var navbar = document.querySelector('dimmas')

    window.onscroll = function() {

        // pageYOffset or scrollY
        if (window.pageYOffset > 0) {
            navbar.classList.add('scrolled')
        } else {
            navbar.classList.remove('scrolled')
        }
    }
</script>
<script>
    $('.navTrigger').click(function() {
        $(this).toggleClass('active');
        console.log("Clicked menu");
        $("#mainListDiv").toggleClass("show_list");
        $("#mainListDiv").fadeIn();

    });
    $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $('.nav').addClass('affix');
            console.log("OK");
        } else {
            $('.nav').removeClass('affix');
        }
    });
</script>
</body>

</html>

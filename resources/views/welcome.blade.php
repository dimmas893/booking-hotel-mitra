<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Booking Hotel</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

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
        .icon {
            background: url('https://cdn-icons-png.flaticon.com/512/4436/4436481.png');
            height: 16px;
            width: 16px;
            display: block;
            /* Other styles here */
        }

        #div4 {
            overflow-y: auto;
        }

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
<div id="app">
    <div class="main-wrapper container">
        <div class="d-none d-xl-block d-lg-block d-md-block">
            <style>
                .navbar-bg-web {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 600px;
                    background: url('https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/discovery-desktop/hero-banner/2022/07/18/897ebe40-0e9b-40b1-8a39-7ef03ca3444d-1658117837173-81a0774262fc44bfde4ebb9345a51997.png');
                    z-index: -1;
                    background-repeat: no-repeat;
                    background-size: cover;
                }
            </style>
            <div class="navbar-bg-web"></div>
        </div>
        <div class="d-sm-none">
            <style>
                .navbar-bg {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 190px;
                    background: url('https://s-light.tiket.photos/t/01E25EBZS3W0FY9GTG6C42E1SE/discovery-desktop/hero-banner/2022/07/18/897ebe40-0e9b-40b1-8a39-7ef03ca3444d-1658117837173-81a0774262fc44bfde4ebb9345a51997.png');
                    z-index: -1;
                    background-repeat: no-repeat;
                    background-size: cover;


                }
            </style>
            <div class="navbar-bg"></div>
        </div>
        {{-- <div > --}}
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
                                $pencarian = $mitra->take(3);
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

        <div class="main-content">
            <div class="section-header">
                <div class="d-sm-none">
                    <h4 style="color:#f5f5f5">hay, kamu butuh istirahat ??</h4>
                    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
                    <div class="searchBar">
                        <input id="searchQueryInput" readonly data-toggle="search"
                            placeholder="Silahkan cari hotel anda" class="nav-link nav-link-lg" type="text"
                            name="searchQueryInput" placeholder="Search" value="" />
                        <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="#666666"
                                    d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="d-none d-xl-block d-lg-block d-md-block">
                    <div class="navbar navbar-expand-lg main-navbar">
                        <form class="form-inline mr-auto">
                            <div class="search-element">
                                <font style="color:#f5f5f5; font-size:40px; position:relative; left:260px;">hai kamu,
                                    <b>kamu
                                        cari Hotel ?</b>
                                </font>
                                <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
                                    rel="stylesheet">
                                <div class="searchBar" style="position: absolute;">
                                    <input class="form-control pecarian" id="searchQueryInput" type="search"
                                        placeholder="Silahkan cari hotel anda">
                                    <button class="btn" type="submit" style="display: none;"><i
                                            class="fas fa-search" style="display: none;"></i></button>

                                    <div class="search-backdrop"></div>
                                    <div class="search-result">
                                        <div class="search-header mb-2">
                                            Pencarian
                                        </div>

                                        {{ csrf_field() }}
                                        <div id="datapecarian"></div>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="d-none d-xl-block d-lg-block d-md-block">
                <div class="section-body" style="margin-top:500px;">
                    <div id="div4" class="mt-5">
                        <div class="row">
                            @foreach ($mitra as $item)
                                <a href="{{ route('detailmitra', $item->id) }}">
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <article class="article article-style-b">
                                            <div class="article-header">
                                                <div class="article-image"
                                                    data-background="{{ asset('mitrafoto/' . $item->foto) }}">
                                                </div>
                                                <div class="article-badge">
                                                    <div class="article-badge-item bg-danger"><i
                                                            class="fas fa-fire"></i>
                                                        Trending</div>
                                                </div>
                                            </div>
                                            <div class="article-details">
                                                <div class="article-title">
                                                    <h2><a href="#">{{ $item->namamitra }}</a></h2>
                                                </div>
                                                <p>{{ $item->alamatmitralengkap }}. </p>
                                            </div>
                                        </article>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-sm-none" style="margin-top:50px;">
                <div class="section-body">
                    <div>
                        {{-- <h2 class="section-title">Article Style B</h2> --}}
                        <div class="">
                            <div id="div4">
                                <div class="row">
                                    <table>
                                        @foreach ($mitra as $item)
                                            <th>
                                                <a href="{{ route('detailmitra', $item->id) }}">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <article class="article article-style-b">
                                                            <div class="article-header">
                                                                <div class="article-image"
                                                                    data-background="{{ asset('mitrafoto/' . $item->foto) }}">
                                                                </div>
                                                                <div class="article-badge">
                                                                    <div class="article-badge-item bg-danger"><i
                                                                            class="fas fa-fire"></i>
                                                                        Trending</div>
                                                                </div>
                                                            </div>
                                                            <div class="article-details">
                                                                <div class="article-title">
                                                                    <h2><a href="#">{{ $item->namamitra }}</a>
                                                                    </h2>
                                                                </div>
                                                                <p>{{ substr($item->alamatmitralengkap, 0, 50) }}. </p>
                                                                <div class="article-cta">
                                                                    <a href="{{ route('detailmitra', $item->id) }}">Read
                                                                        More <i class="fas fa-chevron-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </article>
                                                    </div>
                                                </a>
                                            </th>
                                        @endforeach
                                        {{-- </div> --}}
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer class="main-footer">
        <div class="footer-left">
            Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                Nauval Azhar</a>
        </div>
        <div class="footer-right">

        </div>
    </footer>
</div>


<!-- General JS Scripts -->
{{-- <script src="{{'assets/modules/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset('assets/modules/popper.js') }}"></script>
<script src="{{ asset('assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    // $(document).ready(function() {
    //     $('#show_data_table').hide();
    //     $('.searchname').keyup(function() {
    //         var searchname = $('.searchname').val();
    //         if (searchname != '') {
    //             var _token = $('input[name="_token"]').val();
    //             $.ajax({
    //                 type: 'post',
    //                 url: "{{ route('autocomplete.search.query') }}",
    //                 data: {
    //                     'name': searchname,
    //                     '_token': _token,
    //                 },
    //                 success: function(response) {
    //                     $('#show_data_table').fadeIn();
    //                     $('#data').html(response);
    //                 }
    //             });
    //         } else {
    //             $('#show_data_table').fadeOut();
    //         }
    //     });
    // });

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

    $(function() {
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
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        type: 'post',
                        url: "{{ route('autocomplete.search.query') }}",
                        data: {
                            '_token': _token,
                        },
                        success: function(response) {
                            $('#pecarianshow').fadeIn();
                            $('#datapecarian').html(response);
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
                    $('#datapecarian').html('');
                }
            });
        }
    });


    // $(document).ready(function() {
    //     $('#pecarianshow').hide();
    //     $('.pecarian').keyup(function() {
    //         var pecarian = $('.pecarian').val();
    //         if (pecarian != '') {
    //             var _token = $('input[name="_token"]').val();
    //             $.ajax({
    //                 type: 'post',
    //                 url: "{{ route('autocomplete.search.query') }}",
    //                 data: {
    //                     'name': pecarian,
    //                     '_token': _token,
    //                 },
    //                 success: function(response) {
    //                     $('#pecarianshow').fadeIn();
    //                     $('#datapecarian').html(response);
    //                 }
    //             });
    //         } else {
    //             $('#pecarianshow').fadeOut();
    //         }
    //     });
    // });
</script>
<script>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('perjanjianbelum'))
    <script type="text/javascript">
        Swal.fire(
            'Upss!!',
            'Belum Kerja Sama Dengan Mitra Tersebut!',
            'info'
        )
    </script>
@endif
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

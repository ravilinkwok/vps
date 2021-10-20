<!DOCTYPE html>
<html lang="en">

@include('frontend.layouts.partials.head._head')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<body>
<div>
    <div class="mainbg">
        <div class="bluebg">
            <div>
                <div class="displayindesktop">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class=""><a href="{{route('/')}}"><img src="{{ asset('images/logo.png') }}" class="logo"
                                                                       alt=""></a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-10 navigationfont">
                                <nav>
                                    <ul class="nav margintop10 justify-content-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('check-in.return')}}">I Have Been Here Before</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('check-in.pre.registered')}}">I Have Been Here Pre-Register</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('login')}}"><button
                                                        class="btn loginbtn">Login</button></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="displayinmobile">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class=""><a href="#"><img src="{{ asset('images/logo.png') }}" class="logo"
                                                                       alt=""></a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-12 navigationfont">
                                    <span
                                            style="font-size:25px;cursor:pointer; margin-top: 0px; position: absolute; font-family: 'poppinsmedium';"
                                            onclick="openNav()">&#9776;</span>

                                <div id="myNav" class="overlay">
                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                    <div class="overlay-content">
                                        <div class="leftnav">
                                            <ul>
                                                <li><a href="#">I Have Been Here Before</a></li>
                                                <li><a href="#">I Have Been Here Pre-Register</a></li>
                                                <li><a href="#">Visitor Pass</a></li>
                                                <li><a href="#">Login</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main" data-mobile-height="">
                @yield('content')
            </div>



        </div>

    </div>

</div>

<script>
    function openNav() {
        document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }
</script>
@yield('extras')

@stack('modals')

@include('frontend.layouts.partials.script._scripts')
</body>

</html>

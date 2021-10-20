@extends('frontend.layouts.frontend')

@section('content')


    <div class="container">
        <div class="leftheadpart">
            <h5>Welcome To</h5>
            <h3>VISITOR PASS MANAGEMENT SYSTEM</h3>
            <h6>Just Click on Below Button For Check-In</h6>
            <button class="btn checkinbtn">Check In</button>
        </div>
    </div>

    <div class="container">
        <div class="deviderline">
        </div>
        <div class="footertext">
            <p>Copyright 2021. All rights reserved by DNL.</p>
        </div>
    </div>
{{--    <section id="pm-banner-1" class="pm-banner-section-1 position-relative custom-css">--}}
{{--        <div class="container">--}}
{{--            <div class="pm-banner-content position-relative">--}}
{{--                <div class="pm-banner-text pm-headline pera-content">--}}
{{--                    <span class="pm-title-tag">{{setting('site_name')}}</span>--}}
{{--                    <br><br>--}}
{{--                    <p>{{setting('site_description')}}</p>--}}
{{--                    <h2> {{strip_tags(setting('welcome_screen'))}} </h2>--}}
{{--                    <br>--}}
{{--                    <div class="ei-banner-btn">--}}
{{--                    <a href="{{ route('check-in.step-one') }}">--}}
{{--                            <img  src="{{ asset('website/img/check-in-icon.png')}}" style="height: 40px;"><span>{{__('Check-in')}}</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="pm-banenr-img position-absolute">--}}
{{--                    <img src="{{asset('images/frontend.png')}}" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection


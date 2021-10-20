@extends('frontend.layouts.frontend')

@section('content')
    <section id="pm-banner-1" class="custom-css-step">
        <div class="container">
                <div class="card border-0" style="margin-top:40px;">
                    <div class="card-body">
                            @if(isset($visitingDetails))
                                    <div class="card" style="border: 0;">
                                        <div class="card-body" id='printMe'>
                                            <div class="id-card-hook"></div>
                                            <div class="img-cards" id="printidcard">
                                                <div class="id-card-holder">
                                                    <div class="id-card">
                                        <div class="row">
                                            <div class="col-6">
                                                <h2>{{ setting('site_name') }} </h2>
                                        <div class="id-card-photo">

                                            @if($visitingDetails->getFirstMediaUrl('visitor'))
                                                <img src="{{ asset($signed_url) }}" alt="">
                                            @else
                                                <img src="{{ asset('images/'.setting('id_card_logo')) }}" alt="">
                                            @endif
                                        </div>
                                        <h2>{{$visitingDetails->visitor->name}}</h2>
                                        <h3>{{__('Ph: ')}}{{$visitingDetails->visitor->phone}}</h3>
                                        <h3>{{__('ID#')}}{{$visitingDetails->reg_no}}</h3>
                                        <h3>{{$visitingDetails->company_name}}</h3>
                                        <h3>{{$visitingDetails->visitor->address}}</h3>
                                        <h2>{{__('VISITED TO')}}</h2>
                                        <h3>{{__('Host:')}} {{$visitingDetails->employee->name}}</h3>
                                        <h3>{{ __('Date') }}: {{date('d-m-Y h:i A', strtotime($visitingDetails->created_at))}}</h3>
                                            </div>
                                            <div class="col-6 text-left">
                                                <h2>Medical Checkup is Mandatory for Plan</h2>
                                                <h3>Pulse Rate: ______________</h3>
                                                <h3>BP. ______________</h3>
                                                <h3>Present Complaint</h3>
                                                <h2>Past History</h2>
                                                <h3>DM ______________  CAD ______________</h3>
                                                <h3>Epilesy one Tubec</h3>
                                                <h3>Asthma: ______________</h3>
                                                <h3>Major Operation: ______________</h3>
                                            </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                                <div class="id-card-logo">
                                                    <img src="http://localhost:8000/images/Deepak-About-Deepak_Nitrite-Logo-300x219.png" alt=""><br>
                                                </div>
                                                <p><strong>{{ setting('site_name') }} </strong></p>
                                                <p><strong>{{ setting('site_address') }} </strong></p>
                                                <p>{{__('Ph:')}} {{ setting('site_phone') }} | {{__('E-mail:')}} {{ setting('site_email') }} </p>
                                            </div>
                                        </div>
                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row justify-content-md-center">
                                                <div class="col-md-3">
                                                    <div style="margin-top: 10px;" class="justify-content-center">
                                                        <div class="btn-group btn-group-justified">
                                                            <a href="{{ route('check-in.step-two') }}" class="btn btn-primary text-white">
                                                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                                                            </a>
                                                            @if($visitingDetails->visitor)
                                                            <a onclick="printDiv('printMe')" href="#" id="print" class="btn btn-success text-white">
                                                                <i class="fa fa-print" aria-hidden="true"></i> Print
                                                            </a>
                                                            @endif
                                                            <a href="{{ route('check-in') }}" class="btn btn-danger text-white ">
                                                                <i class="fa fa-home" aria-hidden="true"></i> Home
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                    </div>
                                @else
                            <div>
                                <p align="center" style="color: red">{{__('ID Not Available')}}</p>
                            </div>
                                @endif
                    </div>
                </div>
        </div>
    </section>
@endsection
@section('scripts')
    

    <script>
        var idCardCss = "{{ asset('css/id-card-print.css') }}";
    </script>

    <script src="{{ asset('js/visitor/view.js') }}"></script>

@endsection


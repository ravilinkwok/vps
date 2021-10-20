@extends('frontend.layouts.frontend')

@section('content')
    <!-- Default Page -->
    <section id="pm-banner-1" class="custom-css-step">
        <div class="container">
            <div class="card border-primary " style="margin-top:100px;" >
                <div class="card-header bg-primary text-white-all" id="Details" align="center">
                    <h4 class="text-white" style="font-weight: bold">{{__('Pre Registered Visitor Details')}}</h4>
                </div>
                <div class="card-body">
                    <div style="margin: auto;">
                        {!! Form::open(['route' => 'check-in.find.pre.visitor', 'id' => 'myForm']) !!}
                        <div class="save">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                        {!!  Html::decode(Form::label('email', "Visitor's Pass ID <span class='text-danger'>*</span>", ['class' => 'control-label'])) !!}
                                        {!! Form::text('uid', null, ('' == 'required') ? ['class' => 'form-control input','id '=>'email','required' => 'required', 'placeholder'=>"Visitor Pass ID"] : ['class' => 'form-control input','id '=>'email', 'placeholder'=>"Visitor Pass ID"]) !!}
                                        {!! $errors->first('uid', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('/') }}"
                                               class="btn btn-danger float-left text-white">
                                                <i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Cancel')}}
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success float-right" id="continue">
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i> {{__('Continue')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="application/javascript">
        $(document).ready(function(){
            $("#form-submit").click(function(){
                $("#myForm").submit(); // Submit the form
            });
        });
    </script>
@endsection

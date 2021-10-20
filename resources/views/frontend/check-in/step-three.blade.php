@extends('frontend.layouts.frontend')
@section('style')
    <style>
        #myOnlineCamera video{width:320px;height:240px;margin:15px;float:left;}
        #myOnlineCamera canvas{width:320px;height:240px;margin:15px;float:left;}
        #myOnlineCamera button{clear:both;margin:30px;}
    </style>
@endsection
@section('content')
    <!-- Default Page -->
    <section id="pm-banner-1" class="custom-css-step">
        <div class="container">
            <div class="card"  style="margin-top:40px;">
                <div class="card-header" id="Details" align="center">
                    <h4 style="color: #111570;font-weight: bold">{{__('Answer Questions')}}</h4>
                </div>

                <div class="card-body">
                    @foreach($questions as $key => $question)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" id="Details" >
                                    <h4 style="color: #111570;font-weight: bold">{{$question->statement}}</h4>
                                </div>
                                <div class="card-body ">
                                    <div class="row option-container">
                                            @foreach(explode(",",$question->options) as $key=>$option)
                                                <div class="form-control">
                                                    <input name="{{$question->id}}" type="radio" class="option-answer" data-correct="{{strcmp(preg_replace('/\s+/', '',$option) , preg_replace('/\s+/', '', $question->correct_option))==0 ? "YES" : "NO"}}" id="{{$question->id}}"><label> &nbsp;  {{$option}}</label>
                                                </div>
                                            @endforeach
                                    </div>
                                </div>

                            </div>


                        </div>


                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('check-in.step-one') }}" class="btn btn-primary float-left text-white">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('check-in.step-four') }}" class="btn btn-success float-right text-white">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i> Continue
                            </a>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(e){
            $(".option-answer").on('click',function(e){
               if($(e.currentTarget).attr("data-correct")=="YES"){
                   Swal.fire({
                       icon: 'success',
                       title: 'Well done!',
                       text: 'That is the right answer',

                   });
                   $(e.currentTarget).parents('.form-control').addClass("bg-success")
               }
               else{
                   Swal.fire({
                       icon: 'error',
                       title: 'Oops!',
                       text: 'That is not the right answer...',
                       confirmButtonText: 'Show me the right answer',


                   }).then((result) => {
                       /* Read more about isConfirmed, isDenied below */
                       if (result.isConfirmed) {
                           alert("OK")
                           $(e.currentTarget).parents('.option-container').find('.option-answer[data-correct="YES"]').parents('.form-control').addClass("bg-success  ")
                           $(e.currentTarget).parents('.form-control').addClass("bg-danger  ")
                       } else if (result.isDenied) {
                           $(e.currentTarget).parents('.form-control').addClass("bg-danger  ")
                       }
                   });

               }
            });
        })
    </script>
@endsection

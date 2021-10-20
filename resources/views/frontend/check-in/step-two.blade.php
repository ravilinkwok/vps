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
                    <h4 style="color: #111570;font-weight: bold">{{__('Take Visitor Photo')}}</h4>
                </div>
                {!! Form::open(['route' => 'check-in.step-two.next', 'class' => 'form-horizontal', 'files' => true]) !!}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>{{ __('levels.video_language') }}</label> <span class="text-danger">*</span>
                                            <select id="language_id" name="language_id" class="form-control @error('language_id') is-invalid @enderror">
                                                @foreach($languages as $key => $language)
                                                    <option value="{{ $language->id }}" {{ (old('language_id') == $language->id) ? 'selected' : '' }}>{{ $language->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-4">
                                            <label>{{ __('levels.video_department') }}</label> <span class="text-danger">*</span>
                                            <select id="department_id" name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                                                @foreach($departments as $key => $department)
                                                    <option value="{{ $department->id }}" {{ (old('department_id') == $department->id) ? 'selected' : '' }}>{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-4">
                                            <label><br></label>
                                            <a href="#" class="btn btn-primary form-control load-video">Submit</a>
                                        </div>

                                    </div>

                                    <div class="row mt-4">
                                        <div id="player"></div>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>
                </div>
                <div class="card-footer" id="controls">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('check-in.step-one') }}" class="btn btn-primary float-left text-white">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> back
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-success float-right step-three">
                                Continue <i class="fa fa-arrow-right" aria-hidden="true"></i>
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
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        console.log(firstScriptTag);
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        function loadVideo(vid){
            player = new YT.Player('player', {
                height: '390',
                width: '100%',
                videoId: vid,
                playerVars: {
                    'playsinline': 1
                },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if (event.data == 0) {
                //This means videio has ended
                Swal.fire({
                    icon: 'success',
                    title: 'Yay!',
                    text: 'The video has ended. It is time to answer some questions...',
                    confirmButtonText: 'Take me to questions!',
                    showDenyButton: true,

                    denyButtonText: 'Watch again',


                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $(".step-three").trigger("click");
                    } else if (result.isDenied) {
                        event.target.playVideo();
                    }
                });
                $("#controls").show()
            }
        }
        function stopVideo() {
            player.stopVideo();
        }

        $(document).ready(function(){
            $("#controls").hide();
            $(".step-three").on('click',function(e){
                window.location.href= "{{ route('check-in.step-three') }}"+"/?video_id="+$(e.currentTarget).attr("data-video-id")
            })
            $(".load-video").on("click",function(e){
                $.ajax({
                    type:"POST",
                    data: { department_id: $("#department_id").val(),language_id:$("#language_id").val(), _token: '{{csrf_token()}}' },
                    url:"{{route("check-in.fetch-video")}}",
                    dataType:"json",
                    success:function(data){
                        if(data.video_url == -1)
                        {
                            Swal.fire({
                                icon: 'error',
                                title: 'No Video Found!',
                                text: 'Please contact the security desk',
                                confirmButtonText: 'OK'
                            })
                        }
                        else{
                            $(".step-three").attr("data-video-id",data.id)
                            loadVideo(data.video_url)
                        }


                    }


                })
            });






        })
    </script>
@endsection

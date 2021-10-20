@extends('admin.layouts.master')

@section('main-content')

	<section class="section">
        <div class="section-header">
            <h1>{{ __('Video') }}</h1>
            {{ Breadcrumbs::render('departments/edit') }}
        </div>

        <div class="section-body">
        	<div class="row">
	   			<div class="col-12 col-md-6 col-lg-6">
				    <div class="card">
				    	<form action="{{ route('admin.videos.update', $video) }}" method="POST">
				    		@csrf
				    		@method('PUT')
						    <div class="card-body">


								<div class="form-group">
									<label>{{ __('levels.video_department') }}</label> <span class="text-danger">*</span>
									<select id="department_id" name="department_id" class="form-control @error('department_id') is-invalid @enderror">
										@foreach($departments as $key => $department)
											<option value="{{ $department->id }}" {{ (old('department_id') == $department->id) ? 'selected' : '' }}>{{ $department->name }}</option>
										@endforeach
									</select>

									@error('department_id')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>




								<div class="form-group">
									<label>{{ __('levels.video_language') }}</label> <span class="text-danger">*</span>
									<select id="language_id" name="language_id" class="form-control @error('language_id') is-invalid @enderror">
										@foreach($languages as $key => $language)
											<option value="{{ $language->id }}" {{ (old('language_id') == $language->id) ? 'selected' : '' }}>{{ $language->name }}</option>
										@endforeach
									</select>
									@error('department_id')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
								<div class="form-group">
									<label>{{ __('levels.video_questions') }}</label> <span class="text-danger">*</span>
									<select multiple="multiple" id="questions" name="questions[]" class="form-control @error('questions') is-invalid @enderror">
										@foreach($questions as $key => $question)
											<option value="{{ $question->id }}" {{ (old('questions') == $question->id) ? 'selected' : '' }}>{{ $question->statement }}</option>
										@endforeach
									</select>
									@error('department_id')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>

								<div class="form-group">
									<label>{{ __('levels.video_url') }}</label> <span class="text-danger">*</span>
									<input type="text" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ $video->video_url }}">
									@error('video_url')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>







								<div class="card-footer">
		                    	<button class="btn btn-primary mr-1" type="submit">{{ __('Submit') }}</button>
		                  	</div>
		                </form>
					</div>
				</div>
			</div>
        </div>
    </section>

@endsection

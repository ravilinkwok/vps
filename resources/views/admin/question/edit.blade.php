@extends('admin.layouts.master')

@section('main-content')

	<section class="section">
        <div class="section-header">
            <h1>{{ __('Questions') }}</h1>
            {{ Breadcrumbs::render('departments/edit') }}
        </div>

        <div class="section-body">
        	<div class="row">
	   			<div class="col-12 col-md-6 col-lg-6">
				    <div class="card">
				    	<form action="{{ route('admin.questions.update', $question) }}" method="POST">
				    		@csrf
				    		@method('PUT')
						    <div class="card-body">


								<div class="form-group">
									<label>{{ __('levels.question_name') }}</label> <span class="text-danger">*</span>
									<input type="text" name="statement" class="form-control @error('statement') is-invalid @enderror" value="{{ old('statement',$question->statement) }}">
									@error('statement')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>




								<div class="form-group">
									<label>{{ __('levels.question_code') }}</label> <span class="text-danger">*</span>
									<input type="text" name="uid" class="form-control @error('uid') is-invalid @enderror" value="{{ old('uid',$question->uid) }}">
									@error('uid')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
								<div class="form-group">
									<label>{{ __('levels.question_options') }}</label> <span class="text-danger">*</span>
									<input type="text" name="options" class="form-control @error('options') is-invalid @enderror" value="{{ old('options',$question->options) }}">
									@error('options')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>
								<div class="form-group">
									<label>{{ __('levels.question_correct_option') }}</label> <span class="text-danger">*</span>
									<input type="text" name="correct_option" class="form-control @error('correct_option') is-invalid @enderror" value="{{ old('correct_option',$question->correct_option) }}">
									@error('correct_option')
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

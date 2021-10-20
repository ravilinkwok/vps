@extends('admin.layouts.master')

@section('main-content')

	<section class="section">
        <div class="section-header">
            <h1>{{ __('Languages') }}</h1>
            {{ Breadcrumbs::render('departments/edit') }}
        </div>

        <div class="section-body">
        	<div class="row">
	   			<div class="col-12 col-md-6 col-lg-6">
				    <div class="card">
				    	<form action="{{ route('admin.languages.update', $language) }}" method="POST">
				    		@csrf
				    		@method('PUT')
						    <div class="card-body">


								<div class="form-group">
									<label>{{ __('levels.language_name') }}</label> <span class="text-danger">*</span>
									<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$language->name) }}">
									@error('name')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
									@enderror
								</div>




								<div class="form-group">
									<label>{{ __('levels.language_code') }}</label> <span class="text-danger">*</span>
									<input type="text" name="code" class="form-control @error('video_link') is-invalid @enderror" value="{{ old('name',$language->code) }}">
									@error('status')
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

@extends('admin.layouts.master')

@section('main-content')

	<section class="section">
        <div class="section-header">
            <h1>{{ __('Administrators') }}</h1>
            {{ Breadcrumbs::render('administrators/add') }}
        </div>


		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
        <div class="section-body">
        	<div class="row">
	   			<div class="col-12 col-md-12 col-lg-12">
			    	<form action="{{ route('admin.adminusers.store') }}" method="POST" enctype="multipart/form-data">
			    		@csrf
				    	<div class="card">
					    	<div class="card-body">
					    		<div class="form-row">
							        <div class="form-group col">
				                        <label>{{ __('levels.first_name') }}</label> <span class="text-danger">*</span>
				                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
				                        @error('first_name')
					                        <div class="invalid-feedback">
					                          	{{ $message }}
					                        </div>
					                    @enderror
				                    </div>
							        <div class="form-group col">
				                        <label>{{ __('levels.last_name') }}</label> <span class="text-danger">*</span>
				                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
				                        @error('last_name')
					                        <div class="invalid-feedback">
					                          	{{ $message }}
					                        </div>
					                    @enderror
				                    </div>
				                </div>

				                <div class="form-row">
							        <div class="form-group col">
				                        <label>{{ __('levels.email') }}</label> <span class="text-danger">*</span>
				                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
				                        @error('email')
					                        <div class="invalid-feedback">
					                          	{{ $message }}
					                        </div>
					                    @enderror
				                    </div>
							        <div class="form-group col">
				                        <label>{{ __('levels.phone') }}</label> <span class="text-danger">*</span>
				                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
				                        @error('phone')
					                        <div class="invalid-feedback">
					                          	{{ $message }}
					                        </div>
					                    @enderror
				                    </div>
									<div class="form-group col">
										<label for="location_id">{{ __('Location') }}</label> <span class="text-danger">*</span>
										<select id="location_id" name="location_id" class="form-control @error('location_id') is-invalid @enderror">
											@foreach($locations as $key => $location)
												<option value="{{ $location->id }}" {{ (old('location_id') == $location->id) ? 'selected' : '' }}>{{ $location->name }}</option>
											@endforeach
										</select>
										@error('department_id')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
										@enderror
									</div>

				                </div>

								<div class="form-row">
							        <div class="form-group col">
				                        <label>{{ __('levels.username') }}</label>
				                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
				                        @error('username')
					                        <div class="invalid-feedback">
					                          	{{ $message }}
					                        </div>
					                    @enderror
				                    </div>
							        <div class="form-group col">
				                        <label>{{ __('levels.password') }}</label> <span class="text-danger">*</span>
				                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
				                        @error('password')
					                        <div class="invalid-feedback">
					                          	{{ $message }}
					                        </div>
					                    @enderror
				                    </div>
				                </div>

				                <div class="form-row">

							        <div class="form-group col">
				                        <label>{{ __('levels.address') }}</label>
				                        <textarea name="address" class="form-control small-textarea-height" id="address" cols="30" rows="10">{{ old('address') }}</textarea>
				                        @error('address')
					                        <div class="invalid-feedback">
					                          	{{ $message }}
					                        </div>
					                    @enderror
				                    </div>
				                </div>
							</div>
					        <div class="card-footer">
		                    	<button class="btn btn-primary mr-1" type="submit">{{ __('Submit') }}</button>
		                  	</div>
						</div>
		            </form>
				</div>
        	</div>
        </div>
    </section>

@endsection

@section('scripts')
	<script src="{{ asset('js/adminuser/create.js') }}"></script>
@endsection

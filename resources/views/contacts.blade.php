@extends('layouts.app')

@section('content')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<main>
		@if(Session::has('info'))
			<div class="alert alert-success" role="alert">
  				{{Session::get('info')}}
			</div>
		@endif

		<!-- <div id="map_contact"></div> -->
		<!-- /map -->
		
		<div class="container margin_60_35">
			<div class="row">
				<!--/aside -->
				<div class="col-lg-8 col-md-8 ml-auto">
					<div class="box_general">
						<h3>{{ trans('contacts.title') }}</h3>
						<p>
							{{ trans('contacts.sub_title') }}
						</p>
						<div>
							<div id="message-contact"></div>
							<form method="post" action="{{ route('contacts.postContacts') }}" id="contactform">
								@csrf
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="{{ trans('contacts.name') }}" required>
											@if ($errors->has('name'))
	                                                <span class="invalid-feedback" style="display: block">
	                                                	<strong style="color: red;">{{ $errors->first('name') }}</strong>
	                                                </span>
	                                        @endif
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" id="lastname" value="{{old('lastname')}}" name="lastname" placeholder="{{ trans('contacts.lastname') }}" required>
											@if ($errors->has('lastname'))
	                                                <span class="invalid-feedback" style="display: block">
	                                                	<strong style="color: red;">{{ $errors->first('lastname') }}</strong>
	                                                </span>
	                                        @endif
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" placeholder="{{ trans('contacts.email') }}" required>
											@if ($errors->has('email'))
	                                                <span class="invalid-feedback" style="display: block">
	                                                	<strong style="color: red;">{{ $errors->first('email') }}</strong>
	                                                </span>
	                                        @endif
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" id="phone" name="phone" class="form-control" value="{{old('phone')}}" placeholder="{{ trans('contacts.phone') }}" required>
											@if ($errors->has('phone'))
	                                                <span class="invalid-feedback" style="display: block">
	                                                	<strong>{{ $errors->first('phone') }}</strong>
	                                                </span>
	                                        @endif
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<textarea rows="5" id="message" name="message" class="form-control" style="height:100px;" placeholder="{{ trans('contacts.message') }}" required>{{old('message')}}</textarea>
											@if ($errors->has('message'))
	                                                <span class="invalid-feedback" style="display: block">
	                                                	<strong>{{ $errors->first('message') }}</strong>
	                                                </span>
	                                        @endif
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}">
											</div>
											@if($errors->has('g-recaptcha-response'))
												<span class="invalid-feedback" style="display: block">
													<strong>{{ $errors->first('g-recaptcha-response') 
													}}</strong>
												</span>
											@endif
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="submit" value="{{ trans('contacts.submit') }}" class="btn_1 add_top_20" id="submit-contact">
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /col -->
					</div>
				</div>
				<!-- /col -->
			</div>
			<!-- End row -->
		</div>
		<!-- /container -->
	</main>
	<!-- /main -->

@endsection
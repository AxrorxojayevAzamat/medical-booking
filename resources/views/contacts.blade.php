@extends('layouts.app')

@section('content')

<!-- errors -->
@if(count($errors->all())>0)
	<div class="alert">
	   	<ul>
	   		@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
	   	</ul>
	</div>
@endif

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
				<div class=" col-lg-8 col-md-8 ml-auto">
					<div class="box_general">
						<h3>Contact us</h3>
						<p>
							Mussum ipsum cacilds, vidis litro abertis.
						</p>
						<div>
							<div id="message-contact"></div>
							<form method="post" action="{{ route('contacts.postContacts') }}" id="contactform">
								@csrf
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<input type="text" id="phone" name="phone" class="form-control" placeholder="Phone number" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<textarea rows="5" id="message" name="message" class="form-control" style="height:100px;" placeholder="Hello world!"></textarea required>
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
											<input type="submit" value="Submit" class="btn_1 add_top_20" id="submit-contact">
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
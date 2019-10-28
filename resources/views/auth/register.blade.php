@extends('layouts.login_layout')

@section('content')
<?php $page = "register" ?>
<div class="">

	<div id="wrapper">

		<div class="animate form">
			<section class="login_content">
				<form method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}
					<h1>Create Account</h1>
					<div class="form-group row">

						<div class="col-md-12">
							<input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" required placeholder = "First Name">

							@if ($errors->has('fname'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('fname') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group row">

						<div class="col-md-12">
							<input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" required placeholder = "Last Name">

							@if ($errors->has('lname'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('lname') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-12">
							<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">

							@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-12">
							<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required placeholder="username">

							@if ($errors->has('username'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('username') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group row">

						<div class="col-md-12">
							<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

							@if ($errors->has('password'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group row">

						<div class="col-md-12">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Password Confirmation">
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Register') }}
							</button>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="separator">

						<p class="change_link">Already a member ?
							<a href="{{ route('login') }}" class="to_register"> Log in </a>
						</p>
						<div class="clearfix"></div>
						<br />
						<div>
							<h1><i class="fa fa-bus" style="font-size: 26px;"></i> NFC Based Transport Payment System.</h1>

							<p>©2019 All Rights Reserved. Final Year Project developed by Ishimwe Ayman.</p>
						</div>
					</div>
				</form>
				<!-- form -->
			</section>
			<!-- content -->
		</div>
	</div>
</div>
@endsection
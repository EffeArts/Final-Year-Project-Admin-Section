@extends('layouts.login_layout')

@section('content')
<?php $page = "login" ?>
<div class="">

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <h1>Login Form</h1>
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
            		<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

            		@if ($errors->has('password'))
            		<span class="invalid-feedback" role="alert">
            			<strong>{{ $errors->first('password') }}</strong>
            		</span>
            		@endif
            	</div>
            </div>

            <div>
            	
            		<button type="submit" class="btn btn-primary submit">
            			{{ __('Login') }}
            		</button>
              
             
            		@if (Route::has('password.request'))
            		<a class="reset_pass" href="{{ route('password.request') }}">
            			{{ __('Forgot Your Password?') }}
            		</a>
            		@endif
           
            </div>
                        
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">New to site?
                <a href="{{ route('register') }}" class="to_register"> Create Account </a>
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
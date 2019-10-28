@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		
		<h2>
			Create a new end point
			<hr>
		</h2>
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
		@if(Session::has($msg))

		<div class="alert alert-{{ $msg }}  alert-dismissible fade show" role="alert">
			{{ Session::get($msg) }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
		@endforeach
		<form method="POST" action="{{ route('end_points.store') }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
				<label for="name" class="col-sm-2">Location name</label>
				<div class="col-sm-10">
					<input id="name" class="form-control" placeholder="Location name" required autofocus type="text" name="name" value="{{ old('name') }}">
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>

			</div>
			<button class="btn btn-primary float-right" type="submit">Create</button>

		</form>


		<footer>
			<div class="copyright-info">
				<p class="pull-left">NFC Based Transport payment system 
				</p>
				<p class = "pull-right">©2019 All Rights Reserved. Final Year Project developed by Ishimwe Ayman.</p>
			</div>
			<div class="clearfix"></div>
		</footer>
	</div>
</div>
@endsection

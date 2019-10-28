@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		<h2>
			Admins
		</h2>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-success" href="#" data-toggle="modal" data-target="#createModal">
					<i class="fa fa-user-plus"></i> Add an Admin
				</a>			
			</div>
		</div>
		<table class="table table-striped" id="admins">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope = "col">Username</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 1; ?>
				@foreach($users as $user)

				<tr>
					<th scope="row">{{ $counter }}</th>
					<td>{{ $user->fname }}</td>
					<td>{{ $user->lname }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->username }}</td>

					<td>
						<span class="edit">
							<a class="text-primary" href="{{ route('users.edit', $user->id) }}">
								Edit
							</a>
						</span>
						|
						<span class="delete">
							<a class="text-danger" href="">Delete</a>
						</span>
					</td>
				</tr>
				<?php $counter++; ?>
				@endforeach
			</tbody>
		</table>
		


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

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<form method="POST" action="{{ route('register_admin') }}" id="createForm">
		{{ csrf_field() }}
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Register an Admin</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> 
				</div>
				<div class="modal-body">

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
							<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required placeholder="Email">

							@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-12">
							<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="" required placeholder="username">

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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary float-right" type="submit">Register</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- End of Create Modal -->
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready( function () {
		$('#admins').DataTable();
	} );
</script>
@endsection
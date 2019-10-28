@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		<h2>
			Manage Drivers
		</h2>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#createModal">
					<i class="fa fa-user-plus"></i> Add a new driver
				</a>			
			</div>
		</div>
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
		@if(Session::has($msg))

		<div class="alert alert-{{ $msg }}  alert-dismissible fade in" role="alert">
			{{ Session::get($msg) }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
		@endforeach
		<table class="table table-striped" id="all-drivers">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th class = "hidden-field">id</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th class = "hidden-field">DOB</th>
					<th class = "hidden-field">Gender</th>
					<th scope="col">National ID</th>
					<th scope="col">Contact</th>
					<th class = "hidden-field">email</th>
					<th scope="col">Address</th>
					<th scope="col">Status</th>
					<th scope="col">Driver's Licence Number</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 1; ?>
				@foreach($drivers as $driver)

				<tr>
					<th scope="row">{{ $counter }}</th>
					<td class = "hidden-field">{{ $driver->id }}</td>
					<td>{{ $driver->fname }}</td>
					<td>{{ $driver->lname }}</td>
					<td class = "hidden-field">{{ $driver->dob }}</td>
					<td class = "hidden-field">{{  $driver->gender }}</td>
					<td>{{ $driver->nid }}</td>
					<td>{{ $driver->contact }}</td>
					<td class = "hidden-field">{{ $driver->email }}</td>
					<td>{{ $driver->address }}</td>
					<th scope="row">
						<?php
							switch ($driver->status) {
								case 0:
									echo "<span class = 'text-danger'>Off Duty</span>";
									break;

								case 1:
									echo "<span class = 'text-success'>On Duty</span>";
									break;
								
								default:
									# code...
									break;
							}
						?>
					</td>
					<td>{{ $driver->driver_lic_number }}</td>
					<td>
						<span class="edit">
							<a class="text-primary edit-button" href="#">
								Edit
							</a>
						</span>
						|
						<span class="delete">
							<a class="text-danger" onclick="return confirm('Are you sure you want to delete this driver?');" href="{{ route('driver.delete', $driver->id) }}">
								Delete
							</a>
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
	<form method="POST" action="{{ route('drivers.store') }}" id="createForm" class="form-horizontal form-label-left">
		{{ csrf_field() }}
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Insert a driver</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> 
				</div>
				<div class="modal-body">
					<div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }} row">
						<label for="fname" class="col-sm-2">First Name</label>
						<div class="col-sm-10">
							<input id="fname" class="form-control" placeholder="First Name" required autofocus type="text" name="fname" value="{{ old('fname') }}">
							@if ($errors->has('fname'))
							<span class="help-block">
								<strong>{{ $errors->first('fname') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }} row">
						<label for="lname" class="col-sm-2">Last Name</label>
						<div class="col-sm-10">
							<input id="lname" class="form-control" placeholder="Last Name" required type="text" name="lname" value="{{ old('lname') }}">
							@if ($errors->has('lname'))
							<span class="help-block">
								<strong>{{ $errors->first('lname') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }} row">
						<label for="dob" class="col-sm-2">Date Of Birth</label>
						<div class="col-sm-10">
							<input id="dob" class="form-control" required type="text" placeholder="____/__/__" name = "dob" value="{{ old('dob') }}">
							@if ($errors->has('dob'))
							<span class="help-block">
								<strong>{{ $errors->first('dob') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} row">
						<label for="gender" class="col-sm-2">Gender</label>
						<div class="col-sm-10">
							<select class="form-control" name="gender" id="gender">
								<option value=""  disabled selected>Choose gender</option> 
								<option value = "male">Male</option>
								<option value = "female">Female</option>
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('nid') ? ' has-error' : '' }} row">
						<label for="nid" class="col-sm-2">National ID</label>
						<div class="col-sm-10">
							<input id="nid" class="form-control" required type="text" placeholder="National Id" name = "nid">
							@if ($errors->has('nid'))
							<span class="help-block">
								<strong>{{ $errors->first('nid') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }} row">
						<label for="contact" class="col-sm-2">Contact</label>
						<div class="col-sm-10">
							<input id="contact" class="form-control" placeholder="Contact" required type="text" name="contact" value="{{ old('contact') }}">
							@if ($errors->has('contact'))
							<span class="help-block">
								<strong>{{ $errors->first('contact') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
						<label for="email" class="col-sm-2">Email</label>
						<div class="col-sm-10">
							<input id="email" class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}">
							@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }} row">
						<label for="address" class="col-sm-2">Address</label>
						<div class="col-sm-10">
							<input id="address" class="form-control" required type="text" placeholder="Address" name = "address">
							@if ($errors->has('address'))
							<span class="help-block">
								<strong>{{ $errors->first('address') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('licence') ? ' has-error' : '' }} row">
						<label for="licence" class="col-sm-2">Licence Number</label>
						<div class="col-sm-10">
							<input id="licence" class="form-control" placeholder="Licence Number" required type="text" name="licence" value="{{ old('licence') }}">
							@if ($errors->has('licence'))
							<span class="help-block">
								<strong>{{ $errors->first('licence') }}</strong>
							</span>
							@endif
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary float-right" type="submit">Create</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- End of Create Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<form method="POST" action="/routes" id="editForm">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Edit Driver</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> 
				</div>
				<div class="modal-body">
					<div class="form-group{{ $errors->has('fname1') ? ' has-error' : '' }} row">
						<label for="fname1" class="col-sm-2">First Name</label>
						<div class="col-sm-10">
							<input id="fname1" class="form-control" placeholder="First Name" required autofocus type="text" name="fname1" value="{{ old('fname1') }}">
							@if ($errors->has('fname1'))
							<span class="help-block">
								<strong>{{ $errors->first('fname1') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('lname1') ? ' has-error' : '' }} row">
						<label for="lname1" class="col-sm-2">Last Name</label>
						<div class="col-sm-10">
							<input id="lname1" class="form-control" placeholder="Last Name" required type="text" name="lname1" value="{{ old('lname1') }}">
							@if ($errors->has('lname1'))
							<span class="help-block">
								<strong>{{ $errors->first('lname1') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('dob1') ? ' has-error' : '' }} row">
						<label for="dob1" class="col-sm-2">Date Of Birth</label>
						<div class="col-sm-10">
							<input id="dob1" class="form-control" required type="text" placeholder="____/__/__" name = "dob1" value="{{ old('dob1') }}">
							@if ($errors->has('dob1'))
							<span class="help-block">
								<strong>{{ $errors->first('dob1') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('gender1') ? ' has-error' : '' }} row">
						<label for="gender1" class="col-sm-2">Gender</label>
						<div class="col-sm-10">
							<select class="form-control" name="gender1" id="gender1">
								<option value=""  disabled selected>Choose gender</option> 
								<option value = "male">Male</option>
								<option value = "female">Female</option>
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('nid1') ? ' has-error' : '' }} row">
						<label for="nid1" class="col-sm-2">National ID</label>
						<div class="col-sm-10">
							<input id="nid1" class="form-control" required type="text" placeholder="National Id" name = "nid1">
							@if ($errors->has('nid1'))
							<span class="help-block">
								<strong>{{ $errors->first('nid1') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('contact1') ? ' has-error' : '' }} row">
						<label for="contact1" class="col-sm-2">Contact</label>
						<div class="col-sm-10">
							<input id="contact1" class="form-control" placeholder="Contact" required type="text" name="contact1" value="{{ old('contact1') }}">
							@if ($errors->has('contact1'))
							<span class="help-block">
								<strong>{{ $errors->first('contact1') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('email1') ? ' has-error' : '' }} row">
						<label for="email1" class="col-sm-2">Email</label>
						<div class="col-sm-10">
							<input id="email1" class="form-control" placeholder="Email" type="email" name="email1" value="{{ old('email1') }}">
							@if ($errors->has('email1'))
							<span class="help-block">
								<strong>{{ $errors->first('email1') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }} row">
						<label for="address1" class="col-sm-2">Address</label>
						<div class="col-sm-10">
							<input id="address1" class="form-control" required type="text" placeholder="Address" name = "address1">
							@if ($errors->has('address1'))
							<span class="help-block">
								<strong>{{ $errors->first('address1') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('licence1') ? ' has-error' : '' }} row">
						<label for="licence1" class="col-sm-2">Licence Number</label>
						<div class="col-sm-10">
							<input id="licence1" class="form-control" placeholder="Licence Number" required type="text" name="licence1" value="{{ old('licence1') }}">
							@if ($errors->has('licence1'))
							<span class="help-block">
								<strong>{{ $errors->first('licence1') }}</strong>
							</span>
							@endif
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary float-right" type="submit">Save changes</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- End of edit Modal -->
@endsection

@section('js')
<!-- input mask -->

<script type="text/javascript">
	$(document).ready( function () {
		var table = $('#all-drivers').DataTable();
		//Start Edit record
		table.on('click', '.edit-button', function(){

			$tr = $(this).closest('tr');
			if ($($tr).hasClass('child')) {
				$tr = $tr.prev('.parent');
			}

			var data = table.row($tr).data();
			console.log(data);

			$('#fname1').val(data[2]);
			$('#lname1').val(data[3]);
			$('#dob1').val(data[4]);
			$('#gender1').val(data[5]);
			$('#nid1').val(data[6]);
			$('#contact1').val(data[7]);
			$('#email1').val(data[8]);
			$('#address1').val(data[9]);
			$('#licence1').val(data[11]);

			$('#editForm').attr('action', '/drivers/'+data[1]);
			$('#editModal').modal('show');

		});
		//End Edit record
	} );
</script>
@endsection
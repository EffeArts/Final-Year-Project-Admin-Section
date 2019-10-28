@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		<h2>
			Manage Buses
		</h2>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#createModal">
					<i class="fa fa-user-plus"></i> Add a new bus
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
		<table class="table table-striped" id="buses">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th>id</th>
					<th scope = "col">Model</th>
					<th scope="col">Number plate</th>
					<th scope="col">Driver</th>
					<th scope="col">Route</th>
					<th scope="col">Added at</th>
					<th scope="col">Updated at</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 1; ?>
				@foreach($buses as $bus)

				<tr>
					<th scope="row">{{ $counter }}</th>
					<td>{{ $bus->id }}</td>
					<th>{{ $bus->model }}</th>
					<td style="text-transform: uppercase;">{{ $bus->number_plate }}</td>
					<td>{{ $bus->driver->fname }} {{ $bus->driver->lname }}</td>
					<td>{{ $bus->route->departure->name }} - {{ $bus->route->destination->name }}</td>
					<td>{{ $bus->created_at }}</td>
					<td>{{ $bus->updated_at }}</td>
					<td>
						<span class="edit">
							<a class="text-primary edit-button" href="#">
								Edit
							</a>
						</span>
						|
						<span class="delete">
							<a class="text-danger" onclick="return confirm('Are you sure you want to delete this bus?');" href="{{ route('bus.delete', $bus->id) }}">
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
	<form method="POST" action="{{ route('buses.store') }}" id="createForm">
		{{ csrf_field() }}
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Insert a bus</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> 
				</div>
				<div class="modal-body">
					
					<div class="form-group{{ $errors->has('driver') ? ' has-error' : '' }} row">
						<label for="driver" class="col-sm-2">Driver</label>
						<div class="col-sm-10">
							<select class="form-control" name="driver" id="driver">
								<option value=""  disabled selected>Choose a driver</option>
								@foreach($drivers as $driver)
								<option value="{{ $driver->id }}">{{ $driver->fname }} {{ $driver->lname }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('route') ? ' has-error' : '' }} row">
						<label for="route" class="col-sm-2">Route</label>
						<div class="col-sm-10">
							<select class="form-control" name="route" id="route" required>
								<option value=""  disabled selected>Choose a route</option>
								@foreach($routes as $route)
								<option value="{{ $route->id }}">{{ $route->departure->name }} - {{ $route->destination->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('model') ? ' has-error' : '' }} row">
						<label for="model" class="col-sm-2">Bus model</label>
						<div class="col-sm-10">
							<input id="model" class="form-control" placeholder="Bus Model" required type="text" name="model" value="{{ old('model') }}">
							@if ($errors->has('model'))
							<span class="help-block">
								<strong>{{ $errors->first('model') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('number_plate') ? ' has-error' : '' }} row">
						<label for="number_plate" class="col-sm-2">Number Plate</label>
						<div class="col-sm-10">
							<input id="number_plate" class="form-control" placeholder="Number Plate" required type="text" name="number_plate" value="{{ old('number_plate') }}">
							@if ($errors->has('number_plate'))
							<span class="help-block">
								<strong>{{ $errors->first('number_plate') }}</strong>
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
					<h5 class="modal-title" id="exampleModalLongTitle">Edit bus</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> 
				</div>
				<div class="modal-body">
					
					<div class="form-group{{ $errors->has('driver1') ? ' has-error' : '' }} row">
						<label for="driver1" class="col-sm-2">Driver</label>
						<div class="col-sm-10">
							<select class="form-control" name="driver1" id="driver1" required>
								<option value=""  disabled selected>Choose a driver</option>
								@foreach($drivers as $driver)
								<option value="{{ $driver->id }}">{{ $driver->fname }} {{ $driver->lname }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('route1') ? ' has-error' : '' }} row">
						<label for="route1" class="col-sm-2">Route</label>
						<div class="col-sm-10">
							<select class="form-control" name="route1" id="route1" required>
								<option value=""  disabled selected>Choose a route</option>
								@foreach($routes as $route)
								<option value="{{ $route->id }}">
									{{ $route->departure->name }} - {{ $route->destination->name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary float-right" type="submit">Update</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- End of edit Modal -->
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready( function () {
		var table = $('#buses').DataTable();

		//Start Edit record
		table.on('click', '.edit-button', function(){

			$tr = $(this).closest('tr');
			if ($($tr).hasClass('child')) {
				$tr = $tr.prev('.parent');
			}

			var data = table.row($tr).data();
			console.log(data);

			$('#driver1').val(data[4]);
			$('#route1').val(data[5]);

			$('#editForm').attr('action', '/buses/'+data[1]);
			$('#editModal').modal('show');

		});
		//End Edit record
	} );
</script>
@endsection
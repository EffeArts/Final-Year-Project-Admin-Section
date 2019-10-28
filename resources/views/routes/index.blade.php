@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		<h2>
			Manage Routes
		</h2>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#createModal">
					<i class="fa fa-user-plus"></i> Add a new route
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
		<table class="table table-striped" id="routes">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th class="hidden-field">id</th>
					<th class="hidden-field">departure id</th>
					<th class="hidden-field">destination id</th>
					<th scope="col">Departure</th>
					<th scope="col">Destination</th>
					<th scope="col">Fare (Tsh)</th>
					<th scope="col">Number of buses</th>
					<th scope="col">Created at</th>
					<th scope="col">Updated at</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 1; ?>
				@foreach($routes as $route)

				<tr>
					<th scope="row">{{ $counter }}</th>
					<th class="hidden-field">{{ $route->id }}</th>
					<td class="hidden-field">{{ $route->departure->id }}</td>
					<td class="hidden-field">{{ $route->destination->id }}</td>
					<td>{{ $route->departure->name }}</td>
					<td> {{ $route->destination->name }}</td>
					<td>{{ $route->fare }}</td>
					<td>
						<?php
						
						$number_of_buses = 0;
						foreach ($buses as $bus) {
							if($bus->route_id == $route->id){
								$number_of_buses ++;
							}
						}

						echo "$number_of_buses"; 
						?>
					</td>
					<td>{{ $route->created_at }}</td>
					<td>{{ $route->updated_at }}</td>
					<td>
						<span class="edit">
							<a class="text-primary edit-button" href="#">
								Edit
							</a>
						</span>
						|
						<span class="delete">
							<a class="text-danger" onclick="return confirm('Are you sure you want to delete this route?');" href="{{ route('route.delete', $route->id) }}">
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
	<form method="POST" action="{{ route('routes.store') }}" id="createForm">
		{{ csrf_field() }}
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Insert Route</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> 
				</div>
				<div class="modal-body">
					
					<div class="form-group{{ $errors->has('departure') ? ' has-error' : '' }} row">
						<label for="departure" class="col-sm-2">Departure</label>
						<div class="col-sm-10">
							<select class="form-control" name="departure" id="departure">
								<option value=""  disabled selected>Choose option</option>
								@foreach($endpoints as $endpoint)
								<option value="{{ $endpoint->id }}">{{ $endpoint->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('destination') ? ' has-error' : '' }} row">
						<label for="destination" class="col-sm-2">Destination</label>
						<div class="col-sm-10">
							<select class="form-control" name="destination" id="destination">
								<option value="" disabled selected>Choose option</option>
								@foreach($endpoints as $endpoint)
								<option value="{{ $endpoint->id }}">{{ $endpoint->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('fare') ? ' has-error' : '' }} row">
						<label for="fare" class="col-sm-2">Fare</label>
						<div class="col-sm-10">
							<input id="fare" class="form-control" placeholder="Fare" required autofocus type="text" name="fare" value="{{ old('fare') }}">
							@if ($errors->has('fare'))
							<span class="help-block">
								<strong>{{ $errors->first('fare') }}</strong>
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
					<h5 class="modal-title" id="exampleModalLongTitle">Edit Endpoint</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> 
				</div>
				<div class="modal-body">
					
					<div class="form-group{{ $errors->has('departure1') ? ' has-error' : '' }} row">
						<label for="departure1" class="col-sm-2">Departure</label>
						<div class="col-sm-10">
							<select class="form-control" name="departure1" id="departure1">
								<option value="" selected>Choose option</option>
								@foreach($endpoints as $endpoint)
								<option value="{{ $endpoint->id }}">{{ $endpoint->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('destination1') ? ' has-error' : '' }} row">
						<label for="destination1" class="col-sm-2">Destination</label>
						<div class="col-sm-10">
							<select class="form-control" name="destination1" id="destination1">
								<option value="" disabled selected>Choose option</option>
								@foreach($endpoints as $endpoint)
								<option value="{{ $endpoint->id }}">{{ $endpoint->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group{{ $errors->has('fare1') ? ' has-error' : '' }} row">
						<label for="fare1" class="col-sm-2">Fare</label>
						<div class="col-sm-10">
							<input id="fare1" class="form-control" placeholder="Fare" required autofocus type="text" name="fare1" value="{{ old('fare') }}">
							@if ($errors->has('fare'))
							<span class="help-block">
								<strong>{{ $errors->first('fare') }}</strong>
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
<script type="text/javascript">
	$(document).ready( function () {
		var table = $('#routes').DataTable();

		//Start Edit record
		table.on('click', '.edit-button', function(){

			$tr = $(this).closest('tr');
			if ($($tr).hasClass('child')) {
				$tr = $tr.prev('.parent');
			}

			var data = table.row($tr).data();
			console.log(data);

			$('#departure1').val(data[2]);
			$('#destination1').val(data[3]);
			$('#fare1').val(data[6]);

			$('#editForm').attr('action', '/routes/'+data[1]);
			$('#editModal').modal('show');

		});
		//End Edit record
	} );
</script>
@endsection
@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		<h2>
			Manage End Points
		</h2>

		<div class="row">
			<div class="col-6">
				<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#createModal">
					<i class="fa fa-user-plus"></i> Add a new end point
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
		<table class="table table-striped" id="end_points">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th class="hidden-field">id</th>
					<th scope="col">Name</th>
					<th scope="col">Created at</th>
					<th scope="col">Updated at</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 1; ?>
				@foreach($endpoints as $endpoint)

				<tr>
					<th scope="row">{{ $counter }}</th>
					<td class="hidden-field">{{ $endpoint->id }}</td>
					<td>{{ $endpoint->name }}</td>
					<td>{{ $endpoint->created_at }}</td>
					<td>{{ $endpoint->updated_at }}</td>
					<td>
						<span class="edit">
							<a class="text-primary edit-button" href="#">
								Edit
							</a>
						</span>
						|
						<span class="delete">
							<a class="text-danger" onclick="return confirm('Are you sure you want to delete this endpoint?');" href="{{ route('endpoint.delete', $endpoint->id) }}">
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
	<form method="POST" action="{{ route('end_points.store') }}" id="createForm">
		{{ csrf_field() }}
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Insert Endpoint</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> 
				</div>
				<div class="modal-body">

					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
						<label for="name" class="col-sm-2">Location name</label>
						<div class="col-sm-10">
							<input id="name1" class="form-control" placeholder="Location name" required autofocus type="text" name="name" value="{{ old('name') }}">
							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
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
	<form method="POST" action="/end_points" id="editForm">
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
		var table = $('#end_points').DataTable();

		//Start Edit record
		table.on('click', '.edit-button', function(){

			$tr = $(this).closest('tr');
			if ($($tr).hasClass('child')) {
				$tr = $tr.prev('.parent');
			}

			var data = table.row($tr).data();
			console.log(data);

			$('#name').val(data[2]);

			$('#editForm').attr('action', '/end_points/'+data[1]);
			$('#editModal').modal('show');
			
		});
		//End Edit record
	} );
</script>
@endsection
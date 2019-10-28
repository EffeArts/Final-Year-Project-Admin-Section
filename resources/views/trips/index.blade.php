@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		<h2>
			All Trips
		</h2>

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
		<table class="table table-striped" id="trips">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th class="hidden-field">id</th>
					<th scope="col">Bus Number-Plate</th>
					<th scope="col">Route</th>
					<th scope="col">Driver</th>
					<th scope="col">Fare</th>
					<th scope="col">Travel Card</th>
					<th scope="col">Date and Time</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 1; ?>
				@foreach($trips as $trip)

				<tr>
					<th scope="row">{{ $counter }}</th>
					<th class="hidden-field">{{ $trip->id }}</th>
					<td> {{ $trip->bus->number_plate }}</td>
					<td>
						{{ $trip->route->departure->name }} - {{ $trip->route->destination->name }}
					</td>
					<td>
						{{ $trip->driver->lname }}, {{ $trip->driver->fname }}
					</td>
					<td>{{ $trip->payment }}</td>
					<td>{{ $trip->card->unique_id }}</td>
					<td>{{ $trip->created_at }}</td>
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

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready( function () {
		$('#trips').DataTable();
	} );
</script>
@endsection
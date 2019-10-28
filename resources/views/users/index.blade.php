@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">
		<table class="table table-striped" id="all_users">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope = "col">Username</th>
					<th scope = "col">Created At</th>
					<th scope = "col">Updated At</th>
					<!-- <th scope="col">Actions</th> -->
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
					<td>{{ $user->created_at }}</td>
					<td>{{ $user->updated_at }}</td>
					<!-- <td>
						<span class="edit">
							<a class="text-primary" href="{{ route('users.edit', $user->id) }}">
								Edit
							</a>
						</span>
						|
						<span class="delete">
							<a class="text-danger" href="">Delete</a>
						</span>
					</td> -->
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
		$('#all_users').DataTable();
	} );
</script>
@endsection
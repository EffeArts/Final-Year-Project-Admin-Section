@extends('layouts.fyp')

@section('content')
<div class="main_container">
	@include('home/menu')
	@include('home/top_nav')

	<!-- page content -->
	<div class="right_col" role="main">

		<!-- top tiles -->
		<div class="row tile_count">
			<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
				<div class="left"></div>
				<div class="right">
					<span class="count_top"><i class="fa fa-users"></i> Total Users</span>
					<div class="count">{{ $total_users }}</div>
					<span class="count_bottom"><i class="green">4% </i> From last Week</span>
				</div>
			</div>
			<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
				<div class="left"></div>
				<div class="right">
					<span class="count_top"><i class="fa fa-road"></i> Total Routes</span>
					<div class="count green">{{ $total_routes }}</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
			</div>
			<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
				<div class="left"></div>
				<div class="right">
					<span class="count_top"><i class="fa fa-bus"></i> Total Buses</span>
					<div class="count blue">{{ $total_buses }}</div>
					<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
				</div>
			</div>
			<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
				<div class="left"></div>
				<div class="right">
					<span class="count_top"><i class="fa fa-user"></i> Total Commuters</span>
					<div class="count">{{ $total_commuters }}</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
			</div>
			<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
				<div class="left"></div>
				<div class="right">
					<span class="count_top"><i class="fa fa-male"></i> Total Drivers</span>
					<div class="count">{{ $total_drivers }}</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
			</div>
			<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
				<div class="left"></div>
				<div class="right">
					<span class="count_top"><i class="fa fa-exchange"></i> Total Trips</span>
					<div class="count black">{{ $total_trips }}</div>
					<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
				</div>
			</div>

		</div>


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
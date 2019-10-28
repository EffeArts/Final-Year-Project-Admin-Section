<div class="col-md-3 left_col">
	<div class="left_col scroll-view">

		<div class="navbar nav_title" style="border: 0;">
			<a href="index.html" class="site_title"><h6><i class="fa fa-bus" style="font-size: 20px;"></i> <br/>NFC Based Transport Payment System.</h6></a>
		</div>
		<div class="clearfix"></div>

		<!-- menu prile quick info -->
		<div class="profile">
			<div class="profile_pic">
				<img src="/images/avatars/{{ Auth::user()->avatar }}" alt="profile_pic{{ Auth::user()->lname }}{{ Auth::user()->fname }}" class="img-circle profile_img">
			</div>
			<div class="profile_info">
				<span>Welcome,</span>
				<h2>{{ Auth::user()->lname }}, {{ Auth::user()->fname }}</h2>
			</div>
		</div>
		<!-- /menu prile quick info -->

		<br />

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

			<div class="menu_section">
				<h3>{{ Auth::user()->role->name }}</h3>
				<ul class="nav side-menu">
					<li>
						<a href="{{ route('home')}}">
							<i class="fa fa-home"></i> Home 
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>

					<li>
						<a href="{{ route('users.index')}}">
							<i class="fa fa-users"></i> Users
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>

					<li>
						<a href="{{ route('admins')}}">
							<i class="fa fa-user-secret"></i> Admins
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>

					<li>
						<a href="{{ route('commuters.index')}}">
							<i class="fa fa-ticket"></i> Passengers
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>

					<!-- <li>
						<a href="#">
							<i class="fa fa-sliders"></i> Roles
							<span class="fa fa-chevron-right"></span>
						</a>
					</li> -->
					<li>
						<a href="{{ route('buses.index') }}">
							<i class="fa fa-bus"></i> Buses 
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>
					<li>
						<a href="{{ route('drivers.index') }}">
							<i class="fa fa-male"></i> Drivers
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>
					<li>
						<a href="{{ route('routes.index') }}">
							<i class="fa fa-road"></i> Routes
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>
					<li>
						<a href="{{ route('end_points.index') }}">
							<i class="fa fa-map-marker"></i> End Points
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>
					<li>
						<a href="{{ route('trips.index') }}">
							<i class="fa fa-exchange"></i> Trips
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>
				</ul>
			</div>


		</div>
		<!-- /sidebar menu -->

		<!-- /menu footer buttons -->
		<!-- <div class="sidebar-footer hidden-small">
			<a data-toggle="tooltip" data-placement="top" title="Logout">
				Logout
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div> -->
		<!-- /menu footer buttons -->
	</div>
</div>

<!-- top navigation -->
<div class="top_nav">

	<div class="nav_menu">
		<nav class="" role="navigation">
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="/images/avatars/{{ Auth::user()->avatar }}" alt="profile_pic{{ Auth::user()->lname }}{{ Auth::user()->fname }}">
						{{ Auth::user()->lname }}, {{ Auth::user()->fname }}
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
						<!-- <li><a href="javascript:;">  Profile</a>
						</li>
						<li>
							<a href="javascript:;">
								<span class="badge bg-red pull-right">50%</span>
								<span>Settings</span>
							</a>
						</li>
						<li>
							<a href="javascript:;">Help</a>
						</li> -->
						<li>
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
								Logout
								<i class="fa fa-sign-out pull-right"></i>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					</ul>
				</li>


			</ul>
		</nav>
	</div>

</div>
	<!-- /top navigation -->
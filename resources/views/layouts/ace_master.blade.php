
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<meta name="csrf-token" content="{{csrf_token()}}">
		<title>{{env('APP_ALIAS')}}</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/bootstrap.min.css" />
		<link rel="stylesheet" href="{{asset('ace-master')}}/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
        <link rel="stylesheet" href="{{asset('ace-master')}}/css/jquery.gritter.min.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

        <link rel="stylesheet" href="{{asset('ace-master')}}/css/select2.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/ace-skins.min.css" />
		<link rel="stylesheet" href="{{asset('ace-master')}}/css/ace-rtl.min.css" />

		<!-- ace settings handler -->
		<script src="{{asset('ace-master')}}/js/ace-extra.min.js"></script>

        @yield('styles')
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							<img src="{{asset(env('APP_LOGO'))}}" width="35px" height="35px" style="margin-top:-10px;">
							{{env('APP_ALIAS')}}
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
					<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-danger fa fa-calendar"></i>
														For Overdue
													</span>
													<span class="pull-right badge badge-danger">+12</span>
												</div>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="{{Auth::user()->avatar==null ? asset('/ace-master/images/avatars/profile-pic.jpg') : asset('/storage/users/'.Auth::user()->id.'.png')}}" />
								<span class="user-info">
									<small>Welcome,</small>
									{{Auth::user()->name}}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<li>
									<a href="{{url('profile')}}">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>



				<ul class="nav nav-list">
					<li class="">
						<a href="{{route('home')}}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
                    </li>

                    @php
                        $menus = Config::get('references.menu');
                    @endphp

					@foreach($menus as $menu)
                        @canany($menu['permissions_name'])
                            <li class="">
                                <a href="{{$menu['sub_menu']!=null ? '#' : route($menu['route_name'])}}" class="{{$menu['sub_menu']!=null ? 'dropdown-toggle' : ''}}">
                                    <i class="{{$menu['icon']}}"></i>
                                    <span class="menu-text"> {{$menu['name']}} </span>

                                    <b class="arrow {{$menu['sub_menu']!=null ? ' fa fa-angle-down' : ''}}"></b>
                                </a>

                                <b class="arrow"></b>

                                @if($menu['sub_menu'])

                                <ul class="submenu">
                                    @foreach($menu['sub_menu'] as $submenu)
                                        @can($submenu['permission_name'])
                                            <li class="{{Route::currentRouteName()==$submenu['route_name']? 'active' : ''}}">
                                                <a href="{{$submenu['route_name']!=='#' ? route($submenu['route_name']) : '#'}}">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    {{$submenu['name']}}
                                                </a>

                                                <b class="arrow"></b>
                                            </li>
                                        @endcan
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                        @endcanany
                    @endforeach




				</ul><!-- /.nav-list -->

			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <!-- .breadcrumb -->
                        @yield('content-header')
                        <!-- /.breadcrumb -->
					</div>

					<div class="page-content">


						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                @yield('content')
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{asset('ace-master')}}/js/jquery-2.1.4.min.js"></script>



		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('ace-master')}}/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{asset('ace-master')}}/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="{{asset('ace-master')}}/js/ace-elements.min.js"></script>
		<script src="{{asset('ace-master')}}/js/ace.min.js"></script>
        <script src="{{asset('/ace-master')}}/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('/ace-master')}}/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="{{asset('/ace-master')}}/js/dataTables.buttons.min.js"></script>
        <script src="{{asset('/ace-master')}}/js/dataTables.select.min.js"></script>
        <script src="{{asset('/ace-master')}}/js/dataTables.rowGroup.min.js"></script>
        <script src="{{asset('/ace-master')}}/js/jquery.validate.min.js"></script>
        <script src="{{asset('/ace-master')}}/js/jquery.gritter.min.js"></script>
		<script src="{{asset('/ace-master')}}/js/select2.min.js"></script>
        <script src="{{asset('/js/sweetalert2.js')}}"></script>
        <!-- inline scripts related to this page -->

        <script src="{{asset('/js/fxDataTable.js')}}"></script>
        <script src="{{asset('/js/fxDataTable1.js')}}"></script>
        <script src="{{asset('/js/fxValidate.js')}}"></script>
        <script src="{{asset('/js/fxValidate1.js')}}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

		@yield('scripts')




	</body>
</html>

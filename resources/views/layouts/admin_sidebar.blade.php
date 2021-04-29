<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" style="padding-left:0px;">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="" class="img-circle" src="{{ env('APP_ROOT') }}images/logo_cms.png" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold">InYourLife Delivery</strong></span>
                            <span class="text-muted text-xs block">{{ Auth::user()->name }}<b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">ID+</div>
            </li>
        </ul>
        @section('sidebar-menu')
            <ul class="nav metismenu" id="side-menu" style="padding-left:0px;">
                <li class="{{ (Route::currentRouteName() == 'admin.dashboard') ? "active" : "" }}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="fa fa-th-large"></i>
                        <span class="nav-label">DASHBOARD</span>
                    </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.log') ? "active" : "" }}">
                    <a href="{{route('admin.log')}}" target="_blank">
                        <i class="fa fa-th-large"></i>
                        <span class="nav-label">LOGS</span>
                    </a>
                </li>
            </ul>
        @show
    </div>
</nav>

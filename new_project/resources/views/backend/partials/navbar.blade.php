<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i data-feather="search"></i>
                    </div>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>
        <ul class="navbar-nav">
            @role('supervisor')
            <li class="nav-item dropdown">
                <a href="#" style="margin-right: -4px;font-size: 18px;" class="dropdown-toggle nav-link"
                    data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i> <span class="badge badge-pill">{{count($project)}}</span>
                </a>
                <div class="dropdown-menu notifications notification_css"
                    style="position: absolute;will-change: auto;margin-left: -471%;top: 40px;left: -116px;transform: translate3d(-142px, 9px, 39px);">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                    </div>

                    <div class="noti-content">
                        <ul class="notification-list">
                            @foreach($project as $data)

                            @foreach($data as $rowdata )
                            <li class="notification-message ">
                                <a href="#">
                                    <div class="media-body">
                                        @if($rowdata['is_accepted'] == 0)
                                        <p class="text-secondary"><span
                                                class="noti-title"><strong>{{$rowdata['user']['name']}}</strong>&nbsp;</span>
                                            Added a new
                                            <b> {{$rowdata['name']}}</b> &nbsp; <span
                                                class="noti-title">{{$rowdata['title']}}</span>
                                        </p>
                                        <p class="text-secondary"><span
                                                class="notification-time">{{$rowdata['created']}}
                                            </span></p>
                                        @endif
                                    </div>
                                </a>
                            </li>
                            <hr>
                            @endforeach
                            @endforeach
                        </ul>
                    </div>

                </div>
            </li>
            @endrole
            @role('group')
            <li class="nav-item dropdown">
                <a href="#" style="margin-right: -4px;font-size: 18px;" class="dropdown-toggle nav-link"
                    data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i> <span class="badge badge-pill">{{count($project_data)}}</span>
                </a>
                <div class="dropdown-menu notifications notification_css"
                    style="position: absolute;will-change: auto;margin-left: -471%;top: 40px;left: -116px;transform: translate3d(-142px, 9px, 39px);">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                    </div>

                    <div class="noti-content">
                        <ul class="notification-list">
                            @foreach($project_data as $data)

                            @foreach($data as $rowdata )
                            <li class="notification-message ">
                                <a href="#">
                                    <div class="media-body">
                                        @if($rowdata['is_accepted'] == 1)
                                        <p class="text-secondary"><span
                                                class="noti-title"><strong>{{$rowdata['user']['name']}}</strong>&nbsp;</span>
                                            Your
                                            <b>{{$rowdata['name']}}</b>&nbsp; <span
                                                class="noti-title">{{$rowdata['title']}}</span>
                                            &nbsp; Was Accepted
                                            successfully!
                                        </p>
                                        <p class="text-secondary"><span
                                                class="notification-time">{{$rowdata['created']}}
                                            </span></p>
                                        @endif
                                        @if($rowdata['is_accepted'] == 2)
                                        <p class="text-secondary"><span
                                                class="noti-title"><strong>{{$rowdata['user']['name']}}</strong>&nbsp;</span>
                                            Your
                                            {{$rowdata['name']}} <span class="noti-title">{{$rowdata['title']}}</span>
                                            &nbsp;Was Rejected by
                                            supervisor!
                                        </p>
                                        <p class="text-secondary"><span
                                                class="notification-time">{{$rowdata['created']}}
                                            </span></p>
                                        @endif
                                    </div>
                                </a>
                            </li>
                            <hr>
                            @endforeach
                            @endforeach
                        </ul>
                    </div>

                </div>
            </li>
            @endrole
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="https://via.placeholder.com/30x30" alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="https://via.placeholder.com/80x80" alt="">
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{Auth::user()->name}}</p>
                            <p class="email text-muted mb-3">{{Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn"><i data-feather="log-out"></i>
                                        <span>{{ __('Log out') }}</span></button>
                                </form>

                            </li>
                        </ul>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</nav>
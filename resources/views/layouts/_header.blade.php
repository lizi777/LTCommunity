<nav class="navbar navbar-default navbar-static-top 
@if(if_route('home')) mb-0 @endif
">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                蓝天教育社区
                @guest
                @else - {{ Auth::user()->area()->first()->name }}
                @endguest 
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class={{ active_class(if_route('topics.index')) }}><a href="{{ route('topics.index') }}">话题</a></li>
                <li class={{ active_class(if_route('klasses.show')) }}><a href="{{ route('klasses.show') }}">班级</a></li>
                <li class={{ active_class(if_route('fileuploads.index')) }}><a href="{{ route('fileuploads.index') }}">资源</a></li>
                <li class={{ active_class(if_route('activities.index')) }}><a href="{{ route('activities.index') }}">活动</a></li>
            </ul>
            <form method="GET" action="#" accept-charset="UTF-8" class="navbar-form navbar-left hidden-sm hidden-md">
                <div class="form-group">
                  <input class="form-control search-input mac-style" placeholder="搜索" style="margin: 0" name="q" type="text" value="">
                </div>
            </form>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
            @guest
                <!-- Authentication Links -->
                <li><a href="{{ route('login') }}">登录</a></li>
                <li><a href="{{ route('signup')}}">注册</a></li>
            </ul>
            @else
                <li>
                    <a href="{{ route('topics.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </li>
                {{-- 消息通知标记 --}}
                    <li>
                        <a href="{{ route('notifications.index') }}" class="notifications-badge" style="margin-top: -2px;">
                            <span class="badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }} " title="消息提醒">
                                {{ Auth::user()->notification_count }}
                            </span>
                        </a>
                    </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                    <ul class="dropdown-menu" role="menu">
                        @can('manage_contents')
                            <li>
                                <a href="{{ url(config('administrator.uri')) }}">
                                    <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>
                                    管理后台
                                </a>
                            </li>
                        @endcan
                        
                        <li>
                            <a href="{{ route('users.show', Auth::id()) }}">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                个人中心
                            </a>
                        </li>

                        <li>
                                <a href="{{ route('users.edit', Auth::id()) }}">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    编辑资料
                                </a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                退出登录
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endguest            
        </div>
    </div>
</nav>
<!-- HEADER -->
<header id="header">
    <div id="logo-group">
        <!-- PLACE YOUR LOGO HERE -->
        <!-- <span id="logo"> <img src="{{asset("tcp/img/logoJuzgado500x300.png")}}" alt="Juzgado Federal de Primera Instancia de Ushuaia"> </span> -->
        <!-- END LOGO PLACEHOLDER -->
        @if (Auth::user())
        <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge">
            @if (count(auth()->user()->unreadNotifications))
                 {{ count(auth()->user()->unreadNotifications) }}
            @else
                0
            @endif
        </b> </span>

        <div class="ajax-dropdown">
            {{--  <div class="btn-group btn-group-justified" data-toggle="buttons">
                <label class="btn btn-default">
							<input type="radio" name="activity" id="">
							notificaciones {{ count(auth()->user()->unreadNotifications) }}
                </label>
            </div>  --}}
            <div class="ajax-notifications custom-scroll">
                <div class="alert alert-transparent">
                    <ul class="notification-body">
                        <li>
                            <span class="padding-10 unread">Notificaciones sin leer</span>
                            @forelse (auth()->user()->unreadNotifications as $notification)
                      <a href="#" class="dropdown-item">
                        <i class="fa fa-check fa-fw fa-1x"></i> {{ $notification->data['descripcion'] }}
                        <span class="ml-3 pull-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                      </a>
                      @empty

                      @endforelse
                      <div class="dropdown-divider"></div>

                      <span class="dropdown-header">Notificaciones leidas</span>
                      @forelse (auth()->user()->readNotifications as $notification)
                      <a href="#" class="dropdown-item">
                        <i class="fa fa-check fa-fw fa-1x"></i> {{ $notification->data['descripcion'] }}
                        <span class="ml-3 pull-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                      </a>
                      @empty
                        <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones leidas                      </span>
                      @endforelse
                      <div class="dropdown-divider"></div>
                      <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Marcar leidas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>


    <!-- pulled right: nav area -->
    <div class="pull-right">

        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->

        <!-- #MOBILE -->
        <!-- Top menu profile link : this shows only when top menu is active -->
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
                <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                    <img src="img/avatars/sunny.png" alt="John Doe" class="online" />
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="login.html" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span>
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __(' Salir ') }}
               </a>
            </span>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
        </div>


        <!-- end logout button -->

        <!-- search mobile button (this is hidden till mobile view port) -->
        <div id="search-mobile" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
        </div>
        <!-- end search mobile button -->

      {{--    <!-- input: search field -->
        <form action="search.html" class="header-search pull-right">
            <input id="search-fld"  type="text" name="param" placeholder="Buscar..." data-autocomplete='[
            "ActionScript",
            ]'>
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
            <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
        </form>
        <!-- end input: search field -->  --}}

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
        </div>
        <!-- end fullscreen button -->





    </div>
    <!-- end pulled right: nav area -->


</header>
<!-- END HEADER -->

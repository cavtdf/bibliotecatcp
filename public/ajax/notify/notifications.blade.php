<ul class="notification-body">
    <li>

            <span class="dropdown-header" >Unread Notifications</span>
                @forelse (auth()->user()->unreadNotifications as $notification)
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> {{ $notification->data['titulo'] }}
                    <span class="ml-3 pull-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
                @empty
                    <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones por leer </span>
                @endforelse

                <div class="dropdown-divider"></div>
                <span class="dropdown-header">Read Notifications</span>
                @forelse (auth()->user()->readNotifications as $notification)
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> {{ $notification->data['descripcion'] }}
                    <span class="ml-3 pull-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </a>
                @empty
                    <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones leidas                      </span>
                @endforelse


                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Mark all as read</a>

    </li>

</ul>
<!-- <ul class="notification-body">

    @forelse (auth()->user()->unreadNotifications as $notification)
	<li>
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> {{ $notification->data['titulo'] }}
            <span class="ml-3 pull-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
        </a>
		<span class="padding-10 unread">

			<em class="badge padding-5 no-border-radius bg-color-purple txt-color-white pull-left margin-right-5">
				<i class="fa fa-calendar fa-fw fa-2x"></i>
			</em>

			<span>
				 <a href="javascript:void(0);" class="display-normal"><strong>Calendar</strong></a>: Sadi Orlaf invites you to lunch!
				 <br>
				 <strong>When: 1/3/2014 (1pm - 2pm)</strong><br>
				 <span class="pull-right font-xs text-muted"><i>3 hrs ago...</i></span>
			</span>

		</span>
    </li>
    @empty
    <span class="ml-3 pull-right text-muted text-sm">Sin notificaciones leidas</span>
    @endforelse


</ul> -->

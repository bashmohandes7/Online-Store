<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($notificationsCount)
            <span class="badge badge-warning navbar-badge newNotifications">{{ $notificationsCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header newNotifications">{{ $notificationsCount }} Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notification)
            <div id="notificationsList">
                <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}"
                    class="dropdown-item text-wrap @if ($notification->unread()) text-bold @endif">
                    <i class="{{ $notification->data['icon'] }} mr-2"></i> {{ $notification->data['body'] }}
                    <span
                        class="float-right text-muted text-sm">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</span>
                </a>
                <div class="dropdown-divider"></div>
            </div>
        @endforeach

        <a href="" class="dropdown-item dropdown-footer">See All
            Notifications</a>
    </div>
</li>

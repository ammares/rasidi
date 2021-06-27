@if($configData["mainLayoutType"] === 'horizontal' && isset($configData["mainLayoutType"]))
<nav
  class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-start {{ $configData['navbarColor'] }}"
  data-nav="brand-start">
  @else
  <nav
    class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }}">
    @endif
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
          <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                data-feather="menu"></i></a></li>
        </ul>
      </div>
      <ul class="nav navbar-nav align-items-center ml-auto">
         <li class="nav-item">
          <a class="nav-link" href="{{ route('messages') }}" data-toggle="tooltip" data-placement="top" title="Messags">
            <i class="ficon" data-feather="mail"></i>
          </a>
        </li>
        <li class="nav-item dropdown dropdown-notification mr-25">
          @php
          $unread_notifications_count = auth()->user()->unreadNotifications()->count();
          @endphp
          <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
            <i class="ficon" data-feather="bell"></i>
            @if($unread_notifications_count > 0)
            <span
              class="badge badge-pill badge-danger badge-up notification-badge">{{$unread_notifications_count}}</span>
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
            <li class="dropdown-menu-header">
              <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 mr-auto">{{__('global.notifications')}}</h4>
                @if($unread_notifications_count > 0)
                <div class="badge badge-pill badge-light-primary new-notifications-badge">
                  {{$unread_notifications_count}} {{__('global.new')}}</div>
                @endif
              </div>
            </li>
            <li class="scrollable-container media-list">
              <p class="text-center my-2">{{__('global.no_notifications')}}</p>
            </li>
            <li class="dropdown-menu-footer d-flex justify-content-between">
              <a class="btn btn-link" href="{{url('admin/notifications')}}">
                <i class="fa fa-eye"></i>
                {{ __('global.view_all') }}
              </a>
              <button class="btn btn-link text-danger clear-notifications">
                <i class="fa fa-trash"></i>
                {{ __('global.clear_all') }}
              </button>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('settings') }}" data-toggle="tooltip" data-placement="top"
            title="Settings">
            <i class="ficon" data-feather="settings"></i>
          </a>
        </li>
        <li class="nav-item dropdown dropdown-user">
          <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="user-nav d-sm-flex d-none">
              <span class="user-name font-weight-bolder">{{ auth()->user()->name }}</span>
            </div>
            <span class="avatar">
              <img class="round"
                src="{{ (Auth::user()->avatar && Auth::user()->avatar != 'user_silhouette.png') ? asset('storage/avatars/thumbnail/' . Auth::user()->avatar) : asset('images/custom/user_silhouette.png')}}"
                alt="avatar" height="40" width="40">
              <span class="avatar-status-online"></span>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
            <a href="{{ route('user_profile') }}" class="dropdown-item">
              <i class="mr-50" data-feather="user"></i> {{ __('global.profile') }}
            </a>
            <a href="{{ route('logout') }}" class="dropdown-item"
              onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="mr-50" data-feather="power"></i>{{ __('global.logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>
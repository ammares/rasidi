@php
$configData = App\Helpers\Helper::applClasses();
@endphp
{{-- Horizontal Menu --}}
<div class="horizontal-menu-wrapper ">
  <div class="header-navbar navbar-expand-sm navbar navbar-horizontal {{$configData['horizontalMenuClass']}} {{($configData['theme'] === 'dark') ? 'navbar-dark' : 'navbar-light' }} navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
          <a class="navbar-brand" href="{{url('/')}}">
            <span class="brand-logo">
            <img src="{{asset('storage/logo/logo.png')}}" style="width: 65px; margin-top: 10px;">
            </span>
          </a>
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content d-flex" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation"
       style="margin-top: 5px; font-weight: 500 !important;">
      {{-- Foreach menu item starts --}}
        @if(isset($menuData))
        @foreach($menuData->menu as $menu)
        @php
        $custom_classes = "";
        if(isset($menu->classlist)) {
        $custom_classes = $menu->classlist;
        }
        @endphp
        <li class="nav-item @if(isset($menu->submenu)){{'dropdown'}}@endif {{ $custom_classes }} {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }}"
         @if(isset($menu->submenu)){{'data-menu=dropdown'}}@endif>
          <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="nav-link d-flex align-items-center @if(isset($menu->submenu)){{'dropdown-toggle'}}@endif" target="{{isset($menu->newTab) ? '_blank':'_self'}}"  @if(isset($menu->submenu)){{'data-toggle=dropdown'}}@endif>
            <i data-feather="{{ $menu->icon }}"></i>
            <span style="margin-left: 3px;"> {{ __('locale.'.$menu->name) }}</span>
          </a>
          @if(isset($menu->submenu))
          @include('admin::panels/horizontalSubmenu', ['menu' => $menu->submenu])
          @endif
        </li>
        @endforeach
        @endif
        {{-- Foreach menu item ends --}}
      </ul>
      <ul class="nav navbar-nav ml-auto">
        
        <li class="nav-item dropdown dropdown-notification mr-25" style="margin-top: 2px;">
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
        <li class="nav-item" style="margin-top: 2px;">
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
  </div>
</div>

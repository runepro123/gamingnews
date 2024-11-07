<style>
  .sidebar-dark-primary {
    background: #0e2b44 !important;
  }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{asset('backend/logo/logo.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-bold">{{ $webConfiguration->web_app_name }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth('admin')->user()->name }}</a>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('breaking-news/list') }}" class="nav-link @if(Request::segment(1) == 'breaking-news') active @endif">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>Breaking News</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('news/list') }}" class="nav-link @if(Request::segment(1) == 'news') active @endif">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>News</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ url('live-stream/list') }}" class="nav-link @if(Request::segment(1) == 'live-stream') active @endif">
            <i class="nav-icon fas fa-stream"></i>
            <p>Live Streaming</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="{{ url('reel/list') }}" class="nav-link @if(Request::segment(1) == 'reel') active @endif">
            <i class="nav-icon fas fa-video"></i>
            <p>Reels</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('slider/list') }}" class="nav-link @if(Request::segment(1) == 'slider') active @endif">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>Slider</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('category/list') }}" class="nav-link @if(Request::segment(1) == 'category') active @endif">
            <i class="nav-icon fas fa-cube"></i>
            <p>Categories</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('tag/list') }}" class="nav-link @if(Request::segment(1) == 'tag') active @endif">
            <i class="nav-icon fas fa-tag"></i>
            <p>Tags</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('location/list') }}" class="nav-link @if(Request::segment(1) == 'location') active @endif">
            <i class="nav-icon fas fa-map-marker"></i>
            <p>Locations</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('page/list') }}" class="nav-link @if(Request::segment(1) == 'page') active @endif">
            <i class="nav-icon fas fa-file"></i>
            <p>Pages</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('language/list') }}" class="nav-link @if(Request::segment(1) == 'language') active @endif">
            <i class="nav-icon fas fa-language"></i>
            <p>Languages</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/list') }}" class="nav-link {{ request()->is('admin/list') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Admins</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('users/list') }}" class="nav-link @if(Request::segment(1) == 'users') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('email/list') }}" class="nav-link @if(Request::segment(1) == 'email') active @endif">
            <i class="nav-icon fas fa-envelope"></i>
            <p>Emails</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('ad/list') }}" class="nav-link @if(Request::segment(1) == 'ad') active @endif">
            <i class="nav-icon fas fa-ad"></i>
            <p>Ad Spaces</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('notification') }}" class="nav-link @if(Request::segment(1) == 'notification') active @endif">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>Notification</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('survey/list') }}" class="nav-link @if(Request::segment(1) == 'survey') active @endif">
            <i class="nav-icon fas fa-poll-h"></i>
            <p>Survey</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('settings/advertisement') }}" class="nav-link @if(Request::segment(2) == 'advertisement') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Advertisement</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('settings/notification') }}" class="nav-link @if(Request::segment(2) == 'notification') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Notification Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('settings/general') }}" class="nav-link @if(Request::segment(2) == 'general') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>General Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('settings/web-configuration') }}" class="nav-link @if(Request::segment(2) == 'web-configuration') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Web Configuration</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('settings/mail-configuration') }}" class="nav-link @if(Request::segment(2) == 'mail-configuration') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Mail Configuration</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('settings/social-configuration/list') }}" class="nav-link @if(Request::segment(2) == 'social-configuration') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Social Configuration</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('settings/contact-configuration') }}" class="nav-link @if(Request::segment(2) == 'contact-configuration') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Contact Configuration</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ url('logout') }}" class="nav-link">
            <i class="nav-icon far fa-user"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
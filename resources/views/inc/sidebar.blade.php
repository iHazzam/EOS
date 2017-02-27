@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->contact_name, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->contact_name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i>Logged In</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">USEFUL LINKS</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/create') }}"><i class="fa fa-plus-circle"></i> <span>New Order</span></a></li>

          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/user/settings') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
          @if(Auth::user()->isAdmin())
            <li class="header">ADMIN FUNCTIONS</li>
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/admin/users') }}"><i class="fa fa-users"></i> <span>Manage Site Users</span></a></li>
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/admin/orders') }}"><i class="fa fa-credit-card"></i> <span>See all orders</span></a></li>
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/admin/settings') }}"><i class="fa fa-cogs"></i> <span>Manage Site Settings</span></a></li>
          @endif
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif

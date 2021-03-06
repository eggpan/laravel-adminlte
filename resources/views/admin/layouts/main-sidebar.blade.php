  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
      <img src="{{ url('adminlte/dist/img/AdminLTELogo.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                {{ __('lang.dashboard') }}
              </p>
            </a>
          </li>
          <!--
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          -->
@can('site.adminmenu.read')

          <li class="nav-header">{{ __('lang.admin_menu') }}</li>
  @can('staff.read')
    @if (Str::startsWith(Route::currentRouteName(), 'admin.staff'))
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
    @else
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
    @endif
              <i class="nav-icon far fa-user"></i>
              <p>
                {{ __('lang.staff') }}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
    @if (Route::currentRouteName() === 'admin.staff')
                <a href="{{ route('admin.staff') }}" class="nav-link active">
    @else
                <a href="{{ route('admin.staff') }}" class="nav-link">
    @endif
                  <i class="fas fa-list nav-icon"></i>
                  <p>{{ __('lang.list') }}</p>
                </a>
              </li>
    @can('staff.create')
              <li class="nav-item">
     @if (Route::currentRouteName() === 'admin.staff.create')
                <a href="{{ route('admin.staff.create') }}" class="nav-link active">
      @else
                <a href="{{ route('admin.staff.create') }}" class="nav-link">
      @endif
                  <i class="fas fa-plus nav-icon"></i>
                  <p>{{ __('lang.create') }}</p>
                </a>
              </li>
    @endcan
            </ul><!-- .nav.nav-treeview -->
          </li><!-- .nav-item.has-treeview -->
  @endcan{{-- can('staff.read') --}}

  @can('permission.read')
    @if (Str::startsWith(Route::currentRouteName(), 'admin.role'))
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
    @else
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
    @endif
              <i class="nav-icon far fa-user"></i>
              <p>
                {{ __('lang.role') }}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
    @if (Route::currentRouteName() === 'admin.role')
                <a href="{{ route('admin.role') }}" class="nav-link active">
    @else
                <a href="{{ route('admin.role') }}" class="nav-link">
    @endif
                  <i class="fas fa-list nav-icon"></i>
                  <p>{{ __('lang.list') }}</p>
                </a>
              </li>
            </ul><!-- .nav.nav-treeview -->
          </li><!-- .nav-item.has-treeview -->
  @endcan{{-- can('permission.read') --}}

@endcan{{-- can('site.adminmenu.read') --}}
        </ul>
      </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
  </aside>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <a href="index3.html" class="text-center brand-link">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    
    <div class="sidebar">
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('adminDashboard') }}" class="nav-link {{ request()->routeIs('adminDashboard') ? "active" : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('adminArticles') }}" class="nav-link {{ request()->routeIs('adminArticles') ? "active" : '' }}">
              <i class="nav-icon far fa-newspaper"></i>
              <p>
                Articles
              </p>
            </a>
          </li>
        </ul>
      </nav>
      
    </div>
    
  </aside>



  {{-- For dropdown sidebar --}}
  {{-- <li class="nav-item menu-open">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Home
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Active Page</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Inactive Page</p>
        </a>
      </li>
    </ul>
  </li> --}}
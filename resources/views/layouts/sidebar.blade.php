<aside class="main-sidebar elevation-4 sidebar-light-teal">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link navbar-teal">
      <span class="brand-text font-weight-light" style="color: white">{{ Auth::guard('admin')->user() ? Auth::guard('admin')->user()->name : Auth::user()->name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (Auth::check())
          <li class="nav-item">
            <a href="#" class="nav-link @yield('menProfile')">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          @else
          @if (Auth::guard('admin')->user()->role == 0)
          <li class="nav-item">
            <a href="/admin/admin" class="nav-link @yield('menAdmin')">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="/admin/member" class="nav-link @yield('menMember')">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Member
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/upload/form" class="nav-link @yield('menUpload')">
              <i class="nav-icon fas fa-upload"></i>
              <p>
                Upload Berkas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/profile" class="nav-link @yield('menProfile')">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="/logoutall" class="nav-link" onclick="logout()" id="keluar">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
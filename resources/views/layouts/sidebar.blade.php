<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('users.dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Role</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav --> --}}

      @php
         $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
      @endphp

        @if (in_array("permissions.index", $permissionNames))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('permissions.index') }}">
                    <i class="bi bi-list"></i>
                    <span>Permissions</span>
                </a>
            </li>
        @endif
         
        

        @if (in_array("roles.index", $permissionNames))
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('roles.index') }}">
                <i class="bi bi-list"></i>
                <span>Roles</span>
            </a>
        </li>
      @endif

      @if (in_array("users.index", $permissionNames))
      <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('users.index') }}">
              <i class="bi bi-list"></i>
              <span>Users</span>
          </a>
      </li>
    @endif

    @if (in_array("users.perform", $permissionNames)) 
      <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('login.show') }}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Logout</span>
          </a>
      </li>
    @endif
     

     
    

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('role-list')}}">
          <i class="bi bi-person"></i>
          <span>Roles</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('user-list')}}">
          <i class="bi bi-person"></i>
          <span>User-List</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('user-logout')}}">
          <i class="bi bi-person"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Profile Page Nav --> --}}
    

  </aside><!-- End Sidebar-->
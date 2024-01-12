<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('users.dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

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
     
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#location" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Locations</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="location" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('country.index')}}">
            <i class="bi bi-circle"></i><span>Country</span>
          </a>
        </li>
        <li>
          <a href="{{route('state.index')}}">
            <i class="bi bi-circle"></i><span>State</span>
          </a>
        </li>
        <li>
          <a href="{{route('city.index')}}">
            <i class="bi bi-circle"></i><span>City</span>
          </a>
        </li>
        <li>
          <a href="forms-validation.html">
            <i class="bi bi-circle"></i><span>Form Validation</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->
    

  </aside><!-- End Sidebar-->
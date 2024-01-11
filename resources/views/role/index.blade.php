@extends('layouts.app');
@section('content');

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Role</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Role-List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
          <div class="card">
            <div class="card-header">
              <h1 class="card-title">Roles List</h1>
              <div class="card-div">
                @php
                   $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                @endphp
                @if (in_array("roles.create", $permissionNames))
                  <a href="{{route('roles.create')}}" class="btn btn-primary  float-right">Add role</a>
                @endif
              </div>
            </div>
            <div class="card-body">
              <table class="table">
                <tr>
                   <th>No</th>
                   <th>Name</th>
                   
                   @if (in_array("roles.show", $permissionNames)|| in_array("roles.edit", $permissionNames)||in_array("roles.destroy", $permissionNames))
                      <th>Action</th>
                   @endif
                </tr>
                  @foreach ($roles as $key => $role)
                  <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $role->name }}</td>
                      @php
                          $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                      @endphp
                      <td>
                          @if (in_array("roles.show", $permissionNames))
                            <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>
                          @endif
                          @if (in_array("roles.edit", $permissionNames))
                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                          @endif
                          @if (in_array("roles.destroy", $permissionNames))
                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" href="{{ route('roles.destroy', $role->id) }}">Delete</a>
                          @endif
                      </td>
                  </tr>
                  @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->
@endsection('content');  



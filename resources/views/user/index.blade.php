@extends('layouts.app');
@section('content');
<main id="main" class="main">
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">User-List</li>
          </ol>
        </nav>
    </div>
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
                        <h1 class="card-title">User List</h1>
                        <div class="card-div">
                            @php
                                $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                            @endphp
                            @if (in_array("users.create", $permissionNames))
                                <a href="{{route('users.create')}}" class="btn btn-primary">Add User</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                @if (in_array("users.edit", $permissionNames) || in_array("users.destroy", $permissionNames))
                                 <th scope="col">Action</th>
                                @endif
                              </tr>
                            </thead>
                            @foreach($users as $key => $user)
                            <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        @php
                                            $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                                        @endphp
                                        <td>
                                            @if (in_array("users.edit", $permissionNames))
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info ">Edit</a>                                      
                                            @endif
                                            @if (in_array("users.destroy", $permissionNames))
                                                    <a href="{{ route('users.destroy', $user->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                                            @endif
                                        </td> 
                                    </tr>
                            </tbody>
                            @endforeach
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
  </script>
@endsection('content')
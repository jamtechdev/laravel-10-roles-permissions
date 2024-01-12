@extends('layouts.app');
@section('content');
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Country</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Country-List</li>
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
                        <h1 class="card-title">Country List</h1>
                        <div class="card-div">
                            @php
                                $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                            @endphp
                                @if (in_array("country.create", $permissionNames))
                                    <a href="{{route('country.create')}}" class="btn btn-primary">Add Country</a>
                                @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Country Name</th>
                                @if (in_array("country.edit", $permissionNames) || in_array("country.destroy", $permissionNames))
                                 <th scope="col">Action</th>
                                @endif
                              </tr>
                            </thead>
                            @foreach($countries as $key => $country)
                            <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $country->name }}</td>
                                        @php
                                            $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                                        @endphp
                                        <td>
                                            @if (in_array("country.edit", $permissionNames))
                                                    <a href="{{ route('country.edit', $country->id) }}" class="btn btn-info ">Edit</a>                                      
                                            @endif
                                            @if (in_array("country.destroy", $permissionNames))
                                                    <a href="{{ route('country.destroy', $country->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
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
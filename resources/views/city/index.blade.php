@extends('layouts.app');
@section('content');


<main id="main" class="main">

    <div class="pagetitle">
        <h1>City</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">City-List</li>
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
                        <h1 class="card-title">City List</h1>
                        <div class="card-div">
                            @php
                                $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                            @endphp
                                @if (in_array("city.create", $permissionNames))
                                    <a href="{{route('city.create')}}" class="btn btn-primary">Add City</a>
                                @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col"> country Name</th>
                                <th scope="col">state Name</th>
                                <th scope="col">City Name</th>


                                @if (in_array("city.edit", $permissionNames) || in_array("city.destroy", $permissionNames))
                                 <th scope="col">Action</th>
                                @endif
                              
                              </tr>
                            </thead>
                            @foreach($cities as $key => $city)
                            <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $city->country->name }}</td>
                                        <td>{{ $city->state->name }}</td>
                                        <td>{{ $city->name }}</td>


                                        @php
                                            $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                                        @endphp
                                        <td>
                                            @if (in_array("city.edit", $permissionNames))
                                                    <a href="{{ route('city.edit', $city->id) }}" class="btn btn-info ">Edit</a>                                      
                                            @endif
                                            @if (in_array("city.destroy", $permissionNames))
                                                    <a href="{{ route('city.destroy', $city->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
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
@endsection('content')
@extends('layouts.app');
@section('content');


<main id="main" class="main">

    <div class="pagetitle">
        <h1>State</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">State-List</li>
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
                        <h1 class="card-title">State List</h1>
                        <div class="card-div">
                            @php
                                $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                            @endphp
                                @if (in_array("state.create", $permissionNames))
                                    <a href="{{route('state.create')}}" class="btn btn-primary">Add State</a>
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

                                @if (in_array("state.edit", $permissionNames) || in_array("state.destroy", $permissionNames))
                                 <th scope="col">Action</th>
                                @endif
                              
                              </tr>
                            </thead>
                            @foreach($states as $key => $state)
                            <tbody>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $state->country->name }}</td>
                                        <td>{{ $state->name }}</td>

                                        @php
                                            $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                                        @endphp
                                        <td>
                                            @if (in_array("state.edit", $permissionNames))
                                                    <a href="{{ route('state.edit', $state->id) }}" class="btn btn-info ">Edit</a>                                      
                                            @endif
                                            @if (in_array("state.destroy", $permissionNames))
                                                    <a href="{{ route('state.destroy', $state->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
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
@extends('layouts.app');
@section('content');
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Category-List</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row ">
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
                        <h1 class="card-title">Category List</h1>
                        <div class="card-div" >
                            @php
                            $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                            @endphp
                            @if (in_array("category.create", $permissionNames))
                            <a href="{{route('category.create')}}" class="btn btn-primary btn-sm float-right">Add Category</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th scope="col" >#</th>
                                <th scope="col" >Category Name</th>
                                @if (in_array("category.edit", $permissionNames)|| in_array("category.destroy", $permissionNames))
                                    <th>Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        @php
                                            $permissionNames = Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
                                        @endphp
                                        <td>
                                            @if (in_array("category.edit", $permissionNames))
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info ">Edit</a>
                                            @endif
                                            @if (in_array("category.destroy", $permissionNames))
                                            <a href="{{ route('category.destroy', $category->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger ">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main><!-- End #main -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
  </script>
@endsection('content');  



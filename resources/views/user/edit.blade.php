@extends('layouts.app');
@section('content');


<main id="main" class="main">

    <div class="pagetitle">
        <h1>User</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit-User</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Edit User</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('users.update')}}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$user->id}}">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}">
                              </div>

                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                            </div>

                            <div class="mb-3">
                                <select class ="form-control" id="role" name="role">
                                    <option value="" selected>select role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"{{ in_array($role->name, $userRole) ? 'selected': '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <span style="margin-left: 75%;"><a href="{{route('users.index')}}">back</a></span>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection('content')
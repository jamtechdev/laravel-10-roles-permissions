@extends('layouts.app');
@section('content');

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Show-Role</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container">
        <div class="row ">
            <div class="col-md-10">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title"> Show Role</h1>
                    </div>
                    <div class="card-body">
                        <h4>{{ $roles->name }}</h4>
                        <h1 class="card-title"><h1 class="card-title">Assigned permissions</h1></h1>
                        <table class="table">
                            <thead>
                                <th scope="col" width="20%">Name</th>
                                <th scope="col" width="1%">Guard</th> 
                            </thead>
            
                            @foreach($rolePermissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->guard_name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    
                      <div class="mt-4">
                          <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

@endsection('content');  
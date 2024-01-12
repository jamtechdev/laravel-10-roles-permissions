@extends('layouts.app');
@section('content');
  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Role</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dsshboard</a></li>
            <li class="breadcrumb-item active">Edit-Role</li>
          </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
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
                        <h1 class="card-title" >Edit Role</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('roles.update')}}">
                            @csrf
                            <input value="{{ $role->id }}" 
                                    type="hidden" 
                                    class="form-control" 
                                    name="role_id" 
                                    placeholder="Name" required>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ $role->name }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    placeholder="Name" >
                            </div>
                            <label for="permissions" class="form-label"><h1 class="card-title">Assign Permissions</h1></label>
                            <table class="table">
                                <thead>
                                    <th scope="col"><input type="checkbox" id="all_permission" name="all_permission"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Guard</th> 
                                </thead>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox" 
                                            name="permission[{{ $permission->name }}]"
                                            value="{{ $permission->name }}"
                                            class='permission'
                                            {{ in_array($permission->name, $rolePermissions) 
                                                ? 'checked'
                                                : '' }}>
                                        </td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <a href="{{route('roles.index')}}" class="btn btn-default">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#all_permission').on('click', function() 
            {
                if($(this).is(':checked')) 
                {
                    $.each($('.permission'), function() 
                    {
                        $(this).prop('checked',true);
                    });
                } 
                else 
                {
                    $.each($('.permission'), function()
                    {
                        $(this).prop('checked',false);
                    });
                }
            });
        });
    </script>
  </main>
@endsection('content');  



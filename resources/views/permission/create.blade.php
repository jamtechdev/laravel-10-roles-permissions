@extends('layouts.app');
@section('content');
<main id="main" class="main">
  <div class="pagetitle">
      <h1>Permission</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Add-Permission</li>
        </ol>
      </nav>
  </div>
  <div class="container ">
    <div class="row">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <h1 class="card-title">Add Permission</h1>
          </div>
          <div class="card-body">
            <form method="POST" action="{{route('permissions.store')}}">
              @csrf
              <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input value="{{ old('name') }}" 
                      type="text" 
                      class="form-control" 
                      name="name" 
                      placeholder="Name" >

                  @if ($errors->has('name'))
                      <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                  @endif
              </div>
              <button type="submit" class="btn btn-primary">Save permission</button>
              <a href="{{ route('permissions.index') }}" class="btn btn-default">Back</a>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection('content');  



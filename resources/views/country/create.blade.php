@extends('layouts.app');
@section('content');
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Country</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add-Country</li>
          </ol>
        </nav>
      </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Add Country</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('country.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputname" class="form-label">Country Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <span ><a href="{{route('country.index')}} ">back</a></span>
                          </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection('content')
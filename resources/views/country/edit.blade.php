@extends('layouts.app');
@section('content');

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Country</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit-Country</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Edit Country</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('country.update')}}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="country_id" name="country_id" value="{{$country_id->id}}">

                            <div class="mb-3">
                                <label for="exampleInputname" class="form-label">Country Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$country_id->name}}">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <span ><a href="{{route('country.index')}}">back</a></span>
                          </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection('content')
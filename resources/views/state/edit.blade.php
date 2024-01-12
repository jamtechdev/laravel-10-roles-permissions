@extends('layouts.app');
@section('content');

<main id="main" class="main">
    <div class="pagetitle">
        <h1>State</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add-State</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Add State</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('state.update')}}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="state_id" name="state_id" value="{{$state->id}}">

                            <div class="form-group">
                                <label >Select Country</label>
                                <select  class="form-control" name="Country_id" id="Country_id">
                                    <option value="">Select Category</option>
                                    @foreach ($countries as $country )
                                    <option value="{{ $country->id }}" {{ $country->id == $state->country_id ? 'selected' : '' }}>{{ $country->name }}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('country_name'))
                                <span class="text-danger">{{ $errors->first('country_name') }}</span>
                            @endif
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputname" class="form-label">State Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$state->name}}">
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
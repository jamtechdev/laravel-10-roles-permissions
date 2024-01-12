@extends('layouts.app');
@section('content');
<main id="main" class="main">
    <div class="pagetitle">
        <h1>City</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Add-City</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Add City</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('city.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label >Select Country</label>
                                <select  class="form-control" name="country_id" id="country_id">
                                    <option value="">Select Category</option>
                                    @foreach ($countries as $key => $country )
                                    <option value="{{$country->id}}"  {{ old('country_id') == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_id'))
                                    <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-4">
                                <label >Select state</label>
                                <select id="state_id" name="state_id" class="form-control">
                                </select>
                                @if ($errors->has('state_id'))
                                <span class="text-danger">{{ $errors->first('state_id') }}</span>
                            @endif
                            </div>
                            <div class="form-group mb-4">
                                <label for="exampleInputname" class="form-label">City Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <span ><a href="{{route('city.index')}} ">back</a></span>
                          </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).on('change','#country_id',function()
        {
            let country = $(this).val();
            $("#state_id").html('');
            let locationdata = { country_id : country}
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type :'get',
                url : "{{route('city.fetchstates')}}",
                dataType : 'json',
                data:locationdata,
                success: function(response)
                {
                    $('#state_id').html('<option value="">-- Select State --</option>');
                    $.each(response.data, function (key, value) {
                        $("#state_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            })
        })
    </script>
@endsection('content')
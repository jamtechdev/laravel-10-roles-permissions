@extends('layouts.app');
@section('content');
<main id="main" class="main">
    <div class="pagetitle">
        <h1>City</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit-City</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Edit City</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('city.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="get_state_id" id="get_state_id" value="{{$city->state_id}}">
                            <input type="hidden" name="get_country_id" id="get_country_id" value="{{$city->country_id}}">
                            <input type="hidden" name="city_id" id="city_id" value="{{$city->id}}">

                            <div class="form-group mb-4">
                                <label >Select Country</label>
                                <select  class="form-control" name="Country_id" id="Country_id" onchange="onChangeCountry()" >
                                    <option value="">Select Category</option>
                                    @foreach ($countries as $country )
                                    <option value="{{ $country->id }}" {{ $country->id == $city->country_id ? 'selected' : '' }}>{{ $country->name }}</option>

                                    @endforeach
                                </select>
                                @if ($errors->has('country_name'))
                                <span class="text-danger">{{ $errors->first('country_name') }}</span>
                            @endif
                            </div>

                            <div class="form-group mb-4">
                                <label >Select state</label>
                                <select id="state_id" name="state_id" class="form-control">
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="exampleInputname" class="form-label">City Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$city->name}}">
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
    $(document).ready(function () 
    {
        onChangeCountry();
    });

    function onChangeCountry()
    {
        let country_id = $("#Country_id").val();

        let state_id = $('#get_state_id').val();
        $("#state_id").html('');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url : "{{route('city.fetchstates')}}",
            data: { country_id: country_id },
            dataType: "json",
            success: function(response)
            {
                

                $('#state_id').html('<option value="">-- Select State --</option>');
                $.each(response.data, function (key, value) {
                     let isSeleted = (state_id == value.id)? 'selected':'';
                    $("#state_id").append('<option ' + isSeleted + ' value="'  + value.id + '">' + value.name + '</option>');
                    // $("#state_id").append('<option ' + isSelected + ' value="' + value.id + '">' + value.name + '</option>');

                });

            }
        }); 

    }

    </script>


    
@endsection('content')
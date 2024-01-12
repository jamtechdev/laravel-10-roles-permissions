<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;



class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('city.index', compact('cities'));
    }

    public function create()
    {
        
        $countries = Country::all();
        return view('city.create', compact('countries'));
    }

    public function fetchstates(Request $request)
    {
        
        $states = State::select("name", "id")->where("country_id", $request->country_id)->get();
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $states
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'name' => 'required',
        ]);

        $city = new City();
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id;
        $city->name = $request->name;
        $city->save();

        return redirect()->route('city.index')->with('message', 'Add City Successfully');
    }

    public function edit($id)
    {
        $countries = Country::all();
        $city = City::find($id);
        return view('city.edit', compact('countries', 'city'));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'name' => 'required',
        ]);

        $city = City::find($request->city_id);
        $city->country_id = $request->country_id;
        $city->state_id = $request->state_id;
        $city->name = $request->name;
        $city->save();
        return redirect()->route('city.index')->with('message', 'Update City Successfully');
    }

    public function destory($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect()->route('city.index')->with('message', 'Update City Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;

class StateController extends Controller
{
    public function index()
    {   
        $states = State::all();
        return view('state.index',compact('states'));
    }

    public function create()
    {   
        $countries = Country::all();
        return view('state.create',compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
        ]);
        $country = Country::find ($request->country_id);        
        $state = new State();
        $state->name = $request->name;
        $country->state()->save($state);

        return redirect()->route('state.index')->with('message','Add State Successfully');

    }

    public function edit($id)
    {
        $state = State::find($id);
        $countries = Country::all();

        return view('state.edit',compact('countries','state'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
        ]);
        $country = Country::find ($request->country_id); 
        $update = State::find($request->state_id);
        $update->name = $request->name;
        $country->state()->save($update);

        return redirect()->route('state.index')->with('message','Update State Successfully');

    }

    public function destroy($id)
    {
        $state = State::find($id);
        $state->delete();
        return redirect()->route('state.index')->with('message','Delete State Successfully');

    }


}

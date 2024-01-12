<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function create()
    {
        return view('country.create');
    }

    public function index()
    {   
        $countries = Country::all(); 
        return view('country.index',compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            
        ]);

        $country = new Country();
        $country->name = $request->name;
        $country->save();

        return redirect()->route('country.index')->with('message','Add Country Successfully');
    }

    public function edit($id)
    {
        $country_id =  Country::find($id);
        return view('country.edit', compact('country_id'));
    }

    public function update(Request $request)
    {
        $update = Country::find($request->country_id);
        $update->name = $request->name;
        $update->save();

        return redirect()->route('country.index')->with('message','Update Country Successfully');

    }

    public function destroy($id)
    {
        $country_id = Country::find($id);
        $country_id->delete();

        return redirect()->route('country.index')->with('message','Delete Country Successfully');

    }

    


}

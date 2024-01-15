<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('category.index')->with('message','Add Category Successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = Category::find($request->category_id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('category.index')->with('message','Update Category Successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('message','Update Category Successfully');
    }

    
}

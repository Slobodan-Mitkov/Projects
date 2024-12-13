<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class ServiceCategoryController extends Controller
{
    public function create()
    {
        return view('dashboard.serviceCategories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
        ], [
            'name.required' => 'Please enter a name.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be no more than 255 characters.',
        ]);

        ServiceCategory::create($request->all());
        return redirect()->route('serviceCategories.create')->with('success', 'Service Category created successfully');
    }
}

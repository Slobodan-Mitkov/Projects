<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::all();
        return view('industries.index', compact('industries'));
    }

    public function create()
    {
        return view('industries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'icon' => 'required|url',
        ], [
            'name.required' => 'Please enter a name.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be no more than 255 characters.',
            'description.required' => 'Please enter a description.',
            'description.min' => 'Description must be at least 3 characters.',
            'description.max' => 'Description must be no more than 255 characters.',
            'icon.required' => 'Please enter an icon.',
            'icon.url' => 'Icon must be a valid URL.',
        ]);

        Industry::create($request->all());
        return redirect()->route('industries.create')->with('success', 'Industry created successfully');
    }

    public function edit(Industry $industry)
    {
        return view('industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'icon' => 'required|url',
        ], [
            'name.required' => 'Please enter a name.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be no more than 255 characters.',
            'description.required' => 'Please enter a description.',
            'description.min' => 'Description must be at least 3 characters.',
            'description.max' => 'Description must be no more than 255 characters.',
            'icon.required' => 'Please enter an icon.',
            'icon.url' => 'Icon must be a valid URL.',
        ]);

        $industry->update($request->all());
        return redirect(route('dashboard') . '#industries')->with('success', 'Industry updated successfully');
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();
        return redirect(route('dashboard') . '#industries')->with('success', 'Industry deleted successfully');
    }
}

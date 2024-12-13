<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'testimonial_text' => 'required|max:255',
            'client_name' => 'required|min:2|max:50',
            'client_position' => 'required|min:2|max:50',
            'client_company' => 'required|min:2|max:50',
            'client_profile_picture' => 'required|url',
        ], [
            'testimonial_text.required' => 'Please enter a testimonial text.',
            'testimonial_text.max' => 'Testimonial text must be no more than 500 characters long.',
            'client_name.required' => 'Please enter a client name.',
            'client_name.min' => 'Client name must be at least 2 characters long.',
            'client_name.max' => 'Client name must be no more than 50 characters long.',
            'client_position.required' => 'Please enter a client position.',
            'client_position.min' => 'Client position must be at least 2 characters long.',
            'client_position.max' => 'Client position must be no more than 50 characters long.',
            'client_company.required' => 'Please enter a client company.',
            'client_company.min' => 'Client company must be at least 2 characters long.',
            'client_company.max' => 'Client company must be no more than 50 characters long.',
            'client_profile_picture.required' => 'Please enter a client profile picture.',
            'client_profile_picture.url' => 'Client profile picture must be a valid URL.',
        ]);

        Testimonial::create($request->all());
        return redirect()->route('testimonials.create')->with('success', 'Testimonial created successfully');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'testimonial_text' => 'required|max:255',
            'client_name' => 'required|min:2|max:50',
            'client_position' => 'required|min:2|max:50',
            'client_company' => 'required|min:2|max:50',
            'client_profile_picture' => 'required|url',
        ], [
            'testimonial_text.required' => 'Please enter a testimonial text.',
            'testimonial_text.max' => 'Testimonial text must be no more than 500 characters long.',
            'client_name.required' => 'Please enter a client name.',
            'client_name.min' => 'Client name must be at least 2 characters long.',
            'client_name.max' => 'Client name must be no more than 50 characters long.',
            'client_position.required' => 'Please enter a client position.',
            'client_position.min' => 'Client position must be at least 2 characters long.',
            'client_position.max' => 'Client position must be no more than 50 characters long.',
            'client_company.required' => 'Please enter a client company.',
            'client_company.min' => 'Client company must be at least 2 characters long.',
            'client_company.max' => 'Client company must be no more than 50 characters long.',
            'client_profile_picture.required' => 'Please enter a client profile picture.',
            'client_profile_picture.url' => 'Client profile picture must be a valid URL.',
        ]);

        $testimonial->update($request->all());
        return redirect(route('dashboard') . '#testimonials')->with('success', 'Testimonial updated successfully');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect(route('dashboard') . '#testimonials')->with('success', 'Testimonial deleted successfully');
    }
}

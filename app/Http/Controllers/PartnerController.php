<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\Industry;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('partners.index', compact('partners'));
    }

    public function create()
    {
        $industries = Industry::all();
        return view('partners.create', compact('industries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|min:3|max:255',
            'industry_id' => 'required|exists:industries,id',
            'logo' => 'required|url',
            'collaboration_description' => 'required|min:3|max:255',
        ], [
            'company_name.required' => 'Please enter a company name.',
            'company_name.min' => 'Company name must be at least 3 characters long.',
            'company_name.max' => 'Company name must be no more than 255 characters long.',
            'industry_id.required' => 'Please select an industry.',
            'industry_id.exists' => 'Selected industry does not exist.',
            'logo.required' => 'Please upload a logo.',
            'logo.url' => 'Logo must be a valid URL.',
            'collaboration_description.required' => 'Please enter a collaboration description.',
            'collaboration_description.min' => 'Collaboration description must be at least 3 characters long.',
            'collaboration_description.max' => 'Collaboration description must be no more than 255 characters long.',
        ]);

        Partner::create($request->all());
        return redirect()->route('partners.create')->with('success', 'Partner created successfully');
    }

    public function edit(Partner $partner)
    {
        $industries = Industry::all();
        return view('partners.edit', compact('partner', 'industries'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'company_name' => 'required|min:3|max:255',
            'industry_id' => 'required|exists:industries,id',
            'logo' => 'required|url',
            'collaboration_description' => 'required|min:3|max:255',
        ], [
            'company_name.required' => 'Please enter a company name.',
            'company_name.min' => 'Company name must be at least 3 characters long.',
            'company_name.max' => 'Company name must be no more than 255 characters long.',
            'industry_id.required' => 'Please select an industry.',
            'industry_id.exists' => 'Selected industry does not exist.',
            'logo.required' => 'Please upload a logo.',
            'logo.url' => 'Logo must be a valid URL.',
            'collaboration_description.required' => 'Please enter a collaboration description.',
            'collaboration_description.min' => 'Collaboration description must be at least 3 characters long.',
            'collaboration_description.max' => 'Collaboration description must be no more than 255 characters long.',
        ]);

        $partner->update($request->all());
        return redirect(route('dashboard') . '#partners')->with('success', 'Partner updated successfully');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect(route('dashboard') . '#partners')->with('success', 'Partner deleted successfully');
    }
}

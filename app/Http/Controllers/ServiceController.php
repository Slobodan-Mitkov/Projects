<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Industry;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $service_categories = ServiceCategory::all();
        $industries = Industry::all();
        return view('services.create', compact('service_categories', 'industries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'industry_id' => 'required|exists:industries,id',
        ], [
            'name.required' => 'Please enter a service name.',
            'name.min' => 'Service name must be at least 3 characters long.',
            'name.max' => 'Service name must be no more than 255 characters long.',
            'description.required' => 'Please enter a service description.',
            'description.min' => 'Service description must be at least 3 characters long.',
            'description.max' => 'Service description must be no more than 255 characters long.',
            'service_category_id.required' => 'Please select a service category.',
            'industry_id.required' => 'Please select an industry.',
        ]);

        Service::create($request->all());
        return redirect()->route('services.create')->with('success', 'Service created successfully');
    }

    public function edit(Service $service)
    {
        $service_categories = ServiceCategory::all();
        $industries = Industry::all();
        return view('services.edit', compact('service', 'service_categories', 'industries'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'industry_id' => 'required|exists:industries,id',
        ], [
            'name.required' => 'Please enter a service name.',
            'name.min' => 'Service name must be at least 3 characters long.',
            'name.max' => 'Service name must be no more than 255 characters long.',
            'description.required' => 'Please enter a service description.',
            'description.min' => 'Service description must be at least 3 characters long.',
            'description.max' => 'Service description must be no more than 255 characters long.',
            'service_category_id.required' => 'Please select a service category.',
            'industry_id.required' => 'Please select an industry.',
        ]);

        $service->update($request->all());
        return redirect(route('dashboard') . '#services')->with('success', 'Service updated successfully');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect(route('dashboard') . '#services')->with('success', 'Service deleted successfully');
    }
}

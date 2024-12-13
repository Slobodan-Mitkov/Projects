<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'job_type' => 'required|in:full-time,part-time',
            'work_mode' => 'required|in:hybrid,on-site',
            'location' => 'required|min:3|max:255',
        ], [
            'title.required' => 'Please enter a job title.',
            'title.min' => 'Job title must be at least 3 characters.',
            'title.max' => 'Job title must be no more than 255 characters.',
            'description.required' => 'Please enter a job description.',
            'description.min' => 'Job description must be at least 3 characters.',
            'description.max' => 'Job description must be no more than 255 characters.',
            'job_type.required' => 'Please select a job type.',
            'work_mode.required' => 'Please select a work mode.',
            'location.required' => 'Please enter a location.',
            'location.min' => 'Location must be at least 3 characters.',
            'location.max' => 'Location must be no more than 255 characters.',
        ]);

        Job::create($request->all());
        return redirect()->route('jobs.create')->with('success', 'Job created successfully');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'job_type' => 'required|in:full-time,part-time',
            'work_mode' => 'required|in:hybrid,on-site',
            'location' => 'required|min:3|max:255',
        ], [
            'title.required' => 'Please enter a job title.',
            'title.min' => 'Job title must be at least 3 characters.',
            'title.max' => 'Job title must be no more than 255 characters.',
            'description.required' => 'Please enter a job description.',
            'description.min' => 'Job description must be at least 3 characters.',
            'description.max' => 'Job description must be no more than 255 characters.',
            'job_type.required' => 'Please select a job type.',
            'work_mode.required' => 'Please select a work mode.',
            'location.required' => 'Please enter a location.',
            'location.min' => 'Location must be at least 3 characters.',
            'location.max' => 'Location must be no more than 255 characters.',
        ]);

        $job->update($request->all());
        return redirect(route('dashboard') . '#jobs')->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect(route('dashboard') . '#jobs')->with('success', 'Job deleted successfully');
    }
}

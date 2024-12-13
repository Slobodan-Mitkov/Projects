<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Job;
use App\Models\Member;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Industry;
use App\Models\Service;
use App\Models\Message;
use App\Models\Folder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $jobs = Job::all();
        $members = Member::all();
        $partners = Partner::all();
        $testimonials = Testimonial::all();
        $industries = Industry::all();
        $services = Service::all();
        $messages = Message::all();

        $chartData = [];
        $now = Carbon::now();
        $months = [];

        for ($i = 12; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $monthYear = $month->format('F Y');
            $months[] = $monthYear;
        }

        foreach ($months as $monthYear) {
            $chartData[$monthYear] = 0;
        }

        $jobsPerMonth = Job::selectRaw('YEAR(published_at) as year, MONTH(published_at) as month, COUNT(*) as num_jobs')
            ->groupBy('year', 'month')
            ->get();



        foreach ($jobsPerMonth as $job) {
            $monthYear = Carbon::create($job->year, $job->month)->format('F Y');
            if (isset($chartData[$monthYear])) {
                $chartData[$monthYear] = $job->num_jobs;
            }
        }

        $jobDates = Job::select('published_at as start', 'title', 'description')
            ->get()
            ->map(function ($job) {
                return [
                    'title' => $job->title,
                    'start' => Carbon::parse($job->start)->toIso8601String(),
                    'description' => $job->description,
                ];
            });

        return view('dashboard', compact(
            'jobs',
            'members',
            'partners',
            'testimonials',
            'industries',
            'services',
            'users',
            'chartData',
            'messages'
        ));
    }

    public function charts(Request $request)
    {
        $jobs = Job::all();

        $chartData = [];
        $now = Carbon::now();
        $months = [];

        for ($i = 12; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $monthYear = $month->format('F Y');
            $months[] = $monthYear;
        }

        foreach ($months as $monthYear) {
            $chartData[$monthYear] = 0;
        }

        $jobsPerMonth = Job::selectRaw('YEAR(published_at) as year, MONTH(published_at) as month, COUNT(*) as num_jobs')
            ->groupBy('year', 'month')
            ->get();



        foreach ($jobsPerMonth as $job) {
            $monthYear = Carbon::create($job->year, $job->month)->format('F Y');
            if (isset($chartData[$monthYear])) {
                $chartData[$monthYear] = $job->num_jobs;
            }
        }

        $jobDates = Job::select('published_at as start', 'title', 'description')
            ->get()
            ->map(function ($job) {
                return [
                    'title' => $job->title,
                    'start' => Carbon::parse($job->start)->toIso8601String(),
                    'description' => $job->description,
                ];
            });

        $maxJobs = max($chartData);
        $maxMonth = array_search($maxJobs, $chartData);

        $minJobs = min($chartData);
        $minMonth = array_search($minJobs, $chartData);

        $averageJobs = array_sum($chartData) / count($chartData);

        return view('chart.index', compact(
            'jobs',
            'chartData',
            'maxMonth',
            'maxJobs',
            'minMonth',
            'minJobs',
            'averageJobs',
            'jobDates'
        ));
    }

    public function messages()
    {
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Message deleted successfully');
    }

    public function read(Message $message)
    {
        $message->update(['read' => 1]);

        return view('messages.message', ['message' => $message]);
    }
}

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('jobs', JobsController::class);
    Route::resource('members', MemberController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('industries', IndustryController::class);
    Route::resource('services', ServiceController::class);

    Route::get('serviceCategories/create', [ServiceCategoryController::class, 'create'])->name('serviceCategories.create');
    Route::post('serviceCategories', [ServiceCategoryController::class, 'store'])->name('serviceCategories.store');

    Route::get('dashboard/charts', [DashboardController::class, 'charts'])->name('charts');
    Route::get('dashboard/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::delete('dashboard/messages/{message}', [DashboardController::class, 'destroy'])->name('messages.destroy');
    Route::get('dashboard/messages/{message}/read', [DashboardController::class, 'read'])->name('messages.read');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

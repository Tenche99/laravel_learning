<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
})->name('home');

//index
Route::get(
    '/jobs',
    [JobController::class, 'index']
);

//create
Route::get('/jobs/create', [JobController::class, 'create']);

//show
Route::get('/job/{job}', [JobController::class, 'show']);

//store
Route::post('/jobs', [JobController::class, 'store']);

//edit
Route::get('/job/{job}/edit', [JobController::class, 'edit']);

//update
Route::patch('/job/{job}', [JobController::class, 'update']);

//destroy
Route::delete('/job/{job}', [JobController::class, 'destroy']);

Route::get('/contact', function () {
    return view('contact');
});

require __DIR__ . '/settings.php';

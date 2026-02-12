<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
})->name('home');

//index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

//create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

//show
Route::get('/job/{id}', function ($id) {

    $job = Job::find($id);

    return view('jobs.show', [
        'job' => $job
    ]);
});

//store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);
    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);
    return redirect('/jobs');
});

//edit
Route::get('/job/{id}/edit', function ($id) {

    $job = Job::find($id);

    return view('jobs.edit', [
        'job' => $job
    ]);
});

//update
Route::patch('/job/{id}', function ($id) {
    //validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    //authorize (on hold)
    //update
    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);
    //redirect
    return redirect('/job/' . $job->id);

});

//detroy
Route::delete('/job/{id}', function ($id) {
    $job = Job::findOrFail($id);
    $job->delete();
    return redirect('/jobs');

});

Route::get('/contact', function () {
    return view('contact');
});

require __DIR__ . '/settings.php';

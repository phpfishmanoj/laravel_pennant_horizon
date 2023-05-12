<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;
#use Laravel\Pennant\Feature;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    // if (Feature::active('new-api')) {
    //     dd('Yes this features is active for use');
    // } else {
    //     dd('No service available');
    // }

    $result = Process::run('ls -la'); //for linux
    $result = Process::run('dir');
    //dd($result->successful());
    // dd($result->failed());
    // dd($result->exitCode());
    // dd($result->output());
    // dd($result->errorOutput());
    $result = Process::path(__DIR__ . '../../')->run('dir');
    return dd($result->output());

    //return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

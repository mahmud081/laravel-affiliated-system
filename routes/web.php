<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Models\Code;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $codes = Code::where('user_id', auth()->id())->where('user_registered', null)->get();
    return view('dashboard', compact('codes'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/generate_code', [ProfileController::class, 'generateCode']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/make-affiliated-user', [AdminController::class, 'make_affiliated_user'])->name('admin.make-aff');
    Route::post('/change-role', [AdminController::class, 'change_role']);
});


require __DIR__ . '/auth.php';

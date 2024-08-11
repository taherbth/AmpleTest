<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkHarvesterController;

Route::name('test')->get('test', function(){
    dd(bcrypt('123456'));
});

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');


Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('domains', LinkHarvesterController::class);
    Route::get('get-domain-urls', [LinkHarvesterController::class, 'getDomainUrls'])->name('domains.getDomainUrls');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


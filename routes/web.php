<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Livewire\PasswordReset;
use App\Livewire\PasswordChange;
use App\Livewire\ChangePassword;

Route::middleware('web')
    ->group(base_path('routes/crm.php'))
    ->group(base_path('routes/project.php'));
    
//login
Route::middleware('guest')->group(function () {
Route::get('/', function () {
    return view('login');
})->name('home');
});


Route::get('/change-password', function () {
    return view('change-password');
})->name('change-password')->middleware('auth');


//Route::get('/login', \App\Livewire\Auth\Login::class)->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', function () {
        auth()->logout();
        session()->invalidate();
        return redirect()->route('/');
    })->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});



//test email
Route::get('/send-test-email', function () {
    try {
        Mail::to('generic@example.com')->send(new TestMail());
        return "Test email sent!";
    } catch (\Exception $e) {
        return "Error sending email: " . $e->getMessage();
    }
});

// Route password reset 


require __DIR__ . '/auth.php';

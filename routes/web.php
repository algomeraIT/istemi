<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

Route::middleware('web')
    ->group(base_path('routes/crm.php'))
    ->group(base_path('routes/project.php'));

//login
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/change-password', function () {
        return view('change-password');
    })->name('change-password')->middleware('auth');

    Route::post('/logout', function () {
        auth()->logout();
        session()->invalidate();
        return redirect()->route('/');
    })->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

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


require __DIR__ . '/auth.php';

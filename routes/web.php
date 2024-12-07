<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| These routes are accessible only to authenticated users.
|
*/
Route::middleware(['auth', 'verified'])->group(function () {
    /*
    |----------------------------------------------------------------------
    | Dashboard Routes
    |----------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |----------------------------------------------------------------------
    | Profile Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /*
    |----------------------------------------------------------------------
    | User Dashboard Routes
    |----------------------------------------------------------------------
    */
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are accessible only to authenticated users with admin
| permissions.
|
*/
Route::middleware(['auth'])->group(function () {
    /*
    |----------------------------------------------------------------------
    | Admin Dashboard Routes
    |----------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    /*
    |----------------------------------------------------------------------
    | Event Management Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.lists');
        Route::get('/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/', [EventController::class, 'store'])->name('events.store');
        Route::get('/{event}', [EventController::class, 'show'])->name('events.show');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
        Route::post('/{event}/invitations', [EventController::class, 'addInvitation'])->name('events.addInvitation');
    });

    /*
    |----------------------------------------------------------------------
    | Invitation Management Routes
    |----------------------------------------------------------------------
    */
    Route::delete('/invitations/{invitation}', [InvitationController::class, 'destroy'])->name('admin.invitations.destroy');
    Route::get('/admin/attendance-list', [InvitationController::class, 'attendanceList'])->name('admin.attendance.list');
    Route::get('/attendance/{id}/view', [InvitationController::class, 'viewAttendance'])->name('attendance.view');
    Route::patch('/attendance/{id}/update', [InvitationController::class, 'updateAttendance'])->name('attendance.update');
    Route::delete('/attendance/{id}/delete', [InvitationController::class, 'destroy'])->name('attendance.destroy');
});

/*
|--------------------------------------------------------------------------
| Development Routes
|--------------------------------------------------------------------------
|
| Temporary routes for development and testing purposes only.
| These should be removed in production.
|
*/
Route::get('/test-email', function () {
    Mail::raw('Test email from Laravel', function ($message) {
        $message->to('recipient@example.com')
            ->subject('Test Email');
    });

    return 'Test email sent!';
});

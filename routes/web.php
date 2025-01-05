<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\PaymentController;



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
    Route::get('/user/events', [EventController::class, 'userEvents'])->name('user.events');

    Route::post('/register/attendance/{id}', [EventController::class, 'registerAttendance'])->name('register.attendance');
    Route::post('/mark/attendance/{id}', [EventController::class, 'markAttendanceAsAttended'])->name('mark.attendance');
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

    Route::put('/admin/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.adminpasswordupdate');

    Route::get('/events/donate-list', [DonateController::class, 'index'])->name('events.donateList');
    Route::patch('/donate/{eventId}/toggle', [DonateController::class, 'toggleDonationStatus'])->name('donate.toggle');
    Route::get('/user-event-donations', [DonateController::class, 'userEventDonationList'])->name('user.event.donations');

    // Show the donation form for a specific event
    Route::get('/donate/{eventId}', [DonateController::class, 'showDonationForm'])->name('donation.form');

    // Store the donation
    Route::post('/donate/{eventId}', [DonateController::class, 'storeDonation'])->name('donation.store');

    Route::post('/payment/checkout/{eventId}', [PaymentController::class, 'createCheckoutSession'])->name('payment.checkout');
    Route::get('/payment/success/{eventId}', [PaymentController::class, 'handleSuccess'])->name('payment.success');
    Route::get('/payment/cancel/{eventId}', [PaymentController::class, 'handleCancel'])->name('payment.cancel');





    Route::get('/admin/profile', [AdminProfileController::class, 'show'])->name('admin.profile');
    Route::post('/admin/profile/change-password', [AdminProfileController::class, 'changePassword'])->name('admin.changePassword');


    /*
    |----------------------------------------------------------------------
    | Event Management Routes
    |----------------------------------------------------------------------
    */
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('events.lists');
        Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
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


Route::middleware(['auth'])->group(function () {
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/feedback', [AdminFeedbackController::class, 'index'])->name('admin.feedback.index');
    Route::get('/feedback/{id}/edit', [AdminFeedbackController::class, 'edit'])->name('admin.feedback.edit');
    Route::put('/feedback/{id}', [AdminFeedbackController::class, 'update'])->name('admin.feedback.update');
    Route::delete('/feedback/{id}', [AdminFeedbackController::class, 'destroy'])->name('admin.feedback.destroy');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
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

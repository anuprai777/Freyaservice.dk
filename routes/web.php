<?php

use App\Http\Controllers\Admin\AdminAuditController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminInvoiceController;
use App\Http\Controllers\Admin\AdminMatchingController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Admin\AdminTimesheetController;
use App\Http\Controllers\Admin\AdminWorkerController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\InvoiceController as ClientInvoiceController;
use App\Http\Controllers\Client\RatingController as ClientRatingController;
use App\Http\Controllers\Client\StaffRequestController;
use App\Http\Controllers\Client\TimesheetController as ClientTimesheetController;
use App\Http\Controllers\GdprController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Worker\WorkerAvailabilityController;
use App\Http\Controllers\Worker\WorkerClockInOutController;
use App\Http\Controllers\Worker\WorkerContractController;
use App\Http\Controllers\Worker\WorkerDashboardController;
use App\Http\Controllers\Worker\WorkerDocumentController;
use App\Http\Controllers\Worker\WorkerEarningsController;
use App\Http\Controllers\Worker\WorkerOfferController;
use App\Http\Controllers\Worker\WorkerProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - FreyaService (freyaservice.dk)
|--------------------------------------------------------------------------
*/

// Public landing & localization
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Public standalone pages (navbar links)
Route::get('/services', fn () => view('pages.services'))->name('services');
Route::get('/industries', fn () => view('pages.industries'))->name('industries');
Route::get('/how-it-works', fn () => view('pages.how-it-works'))->name('how-it-works');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');

// Unified Dashboard Gateway (routes users based on their role)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isClient()) {
            return redirect()->route('client.dashboard');
        } elseif ($user->isWorker()) {
            return redirect()->route('worker.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // GDPR tools
    Route::get('/gdpr/export', [GdprController::class, 'export'])->name('gdpr.export');
    Route::post('/gdpr/delete', [GdprController::class, 'requestDeletion'])->name('gdpr.delete');

    // Standard Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| CLIENT PORTAL ROUTES (Companies)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/poll', [ClientDashboardController::class, 'poll'])->name('dashboard.poll');

    // Staff Requests
    Route::get('/requests/create', [StaffRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [StaffRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{staffRequest}', [StaffRequestController::class, 'show'])->name('requests.show');
    Route::post('/requests/{staffRequest}/cancel', [StaffRequestController::class, 'cancel'])->name('requests.cancel');

    // Timesheets Approval
    Route::post('/timesheets/{timesheet}/approve', [ClientTimesheetController::class, 'approve'])->name('timesheets.approve');
    Route::post('/timesheets/{timesheet}/reject', [ClientTimesheetController::class, 'reject'])->name('timesheets.reject');

    // Invoices
    Route::get('/invoices', [ClientInvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}/download', [ClientInvoiceController::class, 'download'])->name('invoices.download');

    // Ratings & Favourites
    Route::post('/ratings', [ClientRatingController::class, 'store'])->name('ratings.store');
    Route::post('/workers/{worker}/toggle-favourite', [ClientRatingController::class, 'toggleFavourite'])->name('workers.toggle-favourite');
});

/*
|--------------------------------------------------------------------------
| WORKER PORTAL ROUTES (Vikarbureau Medarbejdere)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:worker'])->prefix('worker')->name('worker.')->group(function () {
    Route::get('/dashboard', [WorkerDashboardController::class, 'index'])->name('dashboard');

    // Profile & Bank Details
    Route::get('/profile', [WorkerProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [WorkerProfileController::class, 'update'])->name('profile.update');

    // Documents
    Route::get('/documents', [WorkerDocumentController::class, 'index'])->name('documents.index');
    Route::post('/documents', [WorkerDocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/download', [WorkerDocumentController::class, 'download'])->name('documents.download');

    // Availability Calendar
    Route::get('/availability', [WorkerAvailabilityController::class, 'index'])->name('availability.index');
    Route::put('/availability', [WorkerAvailabilityController::class, 'update'])->name('availability.update');

    // Shift Offers & Matching Requests
    Route::get('/offers', [WorkerOfferController::class, 'index'])->name('offers.index');
    Route::post('/offers/{assignment}/accept', [WorkerOfferController::class, 'accept'])->name('offers.accept');
    Route::post('/offers/{assignment}/decline', [WorkerOfferController::class, 'decline'])->name('offers.decline');

    // QR Clock-In & Out
    Route::get('/shifts/scan', [WorkerClockInOutController::class, 'scan'])->name('shifts.scan');
    Route::get('/shifts/scan-qr', [WorkerClockInOutController::class, 'scan'])->name('shifts.scan-qr')->middleware('signed');
    Route::post('/shifts/clock-in', [WorkerClockInOutController::class, 'clockIn'])->name('shifts.clock-in');
    Route::post('/timesheets/{timesheet}/clock-out', [WorkerClockInOutController::class, 'clockOut'])->name('shifts.clock-out');

    // Earnings & History
    Route::get('/earnings', [WorkerEarningsController::class, 'index'])->name('earnings.index');
    Route::get('/contracts', [WorkerContractController::class, 'index'])->name('contracts.index');
    Route::get('/contracts/{contract}', [WorkerContractController::class, 'show'])->name('contracts.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN PORTAL ROUTES (FreyaService Backoffice)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Staff Requests & Shifts
    Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{staffRequest}', [AdminRequestController::class, 'show'])->name('requests.show');
    Route::put('/requests/{staffRequest}/status', [AdminRequestController::class, 'updateStatus'])->name('requests.update-status');
    Route::post('/requests/{staffRequest}/shifts', [AdminRequestController::class, 'addShift'])->name('requests.add-shift');

    // Rule-based Matching Engine
    Route::get('/requests/{staffRequest}/matching', [AdminMatchingController::class, 'show'])->name('matching.show');
    Route::post('/requests/{staffRequest}/dispatch', [AdminMatchingController::class, 'dispatchOffer'])->name('matching.dispatch');

    // Worker CRM
    Route::get('/workers', [AdminWorkerController::class, 'index'])->name('workers.index');
    Route::get('/workers/{worker}', [AdminWorkerController::class, 'show'])->name('workers.show');
    Route::put('/workers/{worker}/status', [AdminWorkerController::class, 'updateStatus'])->name('workers.update-status');
    Route::put('/documents/{document}/verify', [AdminWorkerController::class, 'verifyDocument'])->name('documents.verify');

    // Client CRM
    Route::get('/clients', [AdminClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [AdminClientController::class, 'show'])->name('clients.show');
    Route::put('/clients/{client}/status', [AdminClientController::class, 'updateStatus'])->name('clients.update-status');

    // Timesheets Management & CSV Export
    Route::get('/timesheets', [AdminTimesheetController::class, 'index'])->name('timesheets.index');
    Route::post('/timesheets/{timesheet}/approve', [AdminTimesheetController::class, 'approve'])->name('timesheets.approve');
    Route::get('/timesheets/export/csv', [AdminTimesheetController::class, 'exportCsv'])->name('timesheets.export');

    // Invoices Management, Moms & CSV Export
    Route::get('/invoices', [AdminInvoiceController::class, 'index'])->name('invoices.index');
    Route::post('/invoices/generate', [AdminInvoiceController::class, 'generate'])->name('invoices.generate');
    Route::put('/invoices/{invoice}/status', [AdminInvoiceController::class, 'updateStatus'])->name('invoices.update-status');
    Route::get('/invoices/{invoice}/download', [AdminInvoiceController::class, 'download'])->name('invoices.download');
    Route::get('/invoices/export/csv', [AdminInvoiceController::class, 'exportCsv'])->name('invoices.export');

    // Audit Log
    Route::get('/audit', [AdminAuditController::class, 'index'])->name('audit.index');
});

require __DIR__.'/auth.php';

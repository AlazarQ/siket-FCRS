<?php

use App\Http\Controllers\FCYRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordChangeController;

use App\Exports\FcyRequestExport;
use App\Http\Controllers\DashboardController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\FCY_Request;
use App\Http\Controllers\AuditController;

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
    // Redirect to the new dashboard view after login
    if (session('status') == 'logged_out') {
        return view('auth/login');
    } else {
        return redirect()->route('dashboard'); // Ensure correct route name
    }
});

Route::get('/dashboard', [DashboardController::class, 'adminDash'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); // Ensure this matches the route name used in redirects

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //// fcy request routes
    Route::get('/fcy-request', [FCYRequestController::class, 'index'])->name('fcy-request.index');
    Route::get('/fcy-request/create', [FCYRequestController::class, 'create'])->name('fcy-request.create');
    Route::post('/fcy-request/store', [FCYRequestController::class, 'store'])->name('fcy-request.store');
    Route::get('/fcy-request/{fCY_Request}/edit', [FCYRequestController::class, 'edit'])->name('fcy-request.edit');
    Route::put('/fcy-request/{fCY_Request}/update', [FCYRequestController::class, 'update'])->name('fcy-request.update');
    Route::delete('/fcy-request/{id}/delete', [FCYRequestController::class, 'destroy'])->name('fcy-request.destroy');
    
    ///////// route to list all unauthorized (Registration) requests
    Route::get('/fcy-request/list-unauthorized', [FCYRequestController::class, 'listUnauthorizedRequests'])->name('fcy-request.listUnauthorizedRequests');
    Route::get('/fcy-request/authorize/{id}', [FCYRequestController::class, 'authorizeRequest'])->name('fcy-request.authorize');
    Route::get('/fcy-request/reject/{id}', [FCYRequestController::class, 'rejectRequest'])->name('fcy-request.reject');

    ///////// route to list all unauthorized (Allocation) requests
    Route::get('/fcy-request/list-AuthorizedRequests', [FCYRequestController::class, 'listAuthorizedRequests'])->name('fcy-request.listAuthorizedRequests');
    Route::get('/fcy-request/authorizeAllocation/{id}', [FCYRequestController::class, 'authorizeRequestAllocation'])->name('fcy-request.authorizeAllocation');
    Route::get('/fcy-request/rejectAllocation/{id}', [FCYRequestController::class, 'rejectRequestAllocation'])->name('fcy-request.rejectAllocation');

    // add the route for user menu for add, edit update approve and so on 
    Route::resource('users', UserController::class);
    Route::get('/usersList/unauthorized/list', [UserController::class, 'notAuthorizedUsersList'])
        ->name('users.authOrReject');

    // Route for authorizing a user
    Route::patch('/users/{user}/authorize', [UserController::class, 'authorizeUser'])->name('users.authorize');

    // Route for rejecting a user
    Route::delete('/users/{user}/reject', [UserController::class, 'rejectUser'])->name('users.reject');


    Route::get('/password/change', [PasswordChangeController::class, 'create'])
        ->name('password.change');

    Route::post('/password/change', [PasswordChangeController::class, 'store'])
        ->name('password.change.store');

    /// user password reset routes 
    Route::get('/users/{user}/resetUserPasswordView', [UserController::class, 'resetUserPasswordView'])
        ->name('users.resetUserPasswordView');

    Route::patch('/users/{user}/resetUserPasswordStore', [UserController::class, 'resetUserPasswordStore'])
        ->name('users.resetUserPasswordStore');

    //// report routes
    //All Fcy Request lists
    Route::get('/reports/allFcyRequests', [FCYRequestController::class, 'allFcyRequests'])
        ->name('fcy-request.allFcyRequests');

    Route::get('/reports/unAuthFcyRequests', [FCYRequestController::class, 'unAuthFcyRequests'])
        ->name('fcy-request.unAuthFcyRequests');

    Route::get('/reports/authFcyRequests', [FCYRequestController::class, 'authFcyRequests'])
        ->name('fcy-request.authFcyRequests');

    Route::get('/reports/approvedFcyRequests', [FCYRequestController::class, 'approvedFcyRequests'])
        ->name('fcy-request.approvedFcyRequests');

    Route::get('/reports/rejectedFcyRequests', [FCYRequestController::class, 'rejectedFcyRequests'])
        ->name('fcy-request.rejectedFcyRequests');


    //// export reports route
    Route::get('/fcy-request/export/excel', function () {
        return Excel::download(new FcyRequestExport, 'fcy_requests.xlsx');
    })->name('fcy-request.export.excel');

    Route::get('/fcy-request/export/pdf', function () {
        $data = FCY_Request::all();
        $pdf = Pdf::loadView('fcy-request.export.export_pdf', ['allFcyRequest' => $data]);
        return $pdf->download('fcy_requests.pdf');
    })->name('fcy-request.export.pdf');

    //// error pages 
    Route::get('/unauthorized', function () {
        return view('error.403');
    })->name('unauthorized');

    /// audit Routes 
    Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
});

// useless routes
// Just to demo sidebar dropdown links active states.
// Route::get('/buttons/text', function () {
//     return view('buttons-showcase.text');
// })->middleware(['auth'])->name('buttons.text');

// Route::get('/buttons/icon', function () {
//     return view('buttons-showcase.icon');
// })->middleware(['auth'])->name('buttons.icon');

// Route::get('/buttons/text-icon', function () {
//     return view('buttons-showcase.text-icon');
// })->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// ================= ADMIN =================
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController as AdminStudentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\Admin\WardenController;
use App\Http\Controllers\RoomMovementController;

// ================= STUDENT =================
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentDashboardController;

// ================= WARDEN =================
use App\Http\Controllers\WardenAuthController;
use App\Http\Controllers\Warden\WardenDashboardController;
use App\Http\Controllers\Warden\StudentController as WardenStudentController;
use App\Http\Controllers\Warden\WardenFeeController;
use App\Http\Controllers\Warden\GatePassController;


Route::get('/', function () {
    return 'Smart Hostel is LIVE 🚀';
});

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'))->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

// Admin login page
Route::get('/login', fn () => view('auth.login'))->name('login');

// Admin login submit
Route::post('/login', function (Request $request) {

    // logout other roles
    Auth::guard('warden')->logout();
    Auth::guard('student')->logout();

    // clean old session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('web')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid admin credentials'
    ]);

})->name('login.submit');

// Admin logout
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::middleware('auth:web')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('students', AdminStudentController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('fees', FeeController::class);

    Route::get('/rooms/{room}/movements',
        [RoomMovementController::class, 'index']
    )->name('rooms.movements');

    Route::get('/fees/{fee}/receipt/pdf',
        [FeeController::class, 'receiptPdf']
    )->name('fees.receipt.pdf');

    Route::get('/admin/wardens',
        [WardenController::class, 'index']
    )->name('admin.wardens.index');

    Route::get('/admin/wardens/create',
        [WardenController::class, 'create']
    )->name('admin.wardens.create');

    Route::post('/admin/wardens',
        [WardenController::class, 'store']
    )->name('admin.wardens.store');
});

/*
|--------------------------------------------------------------------------
| STUDENT AUTH
|--------------------------------------------------------------------------
*/

// Student login
Route::get('/student/login',
    [StudentAuthController::class, 'showLogin']
)->name('student.login');

Route::post('/student/login',
    [StudentAuthController::class, 'login']
)->name('student.login.submit');

Route::post('/student/logout',
    [StudentAuthController::class, 'logout']
)->name('student.logout');

/*
|--------------------------------------------------------------------------
| STUDENT PANEL
|--------------------------------------------------------------------------
*/
Route::middleware('auth:student')->group(function () {

    Route::get('/student/dashboard',
        [StudentDashboardController::class, 'index']
    )->name('student.dashboard');

    Route::get('/student/profile',
        [StudentDashboardController::class, 'profile']
    )->name('student.profile');

    Route::get('/student/movements',
        [StudentDashboardController::class, 'movements']
    )->name('student.movements');

    Route::get('/student/fees/{fee}/receipt',
        [StudentDashboardController::class, 'feeReceipt']
    )->name('student.fees.receipt');

    Route::get('/student/gate-pass',
        [StudentDashboardController::class, 'gatePassForm']
    )->name('student.gatepass.form');

    Route::post('/student/gate-pass',
        [StudentDashboardController::class, 'submitGatePass']
    )->name('student.gatepass.submit');
});

/*
|--------------------------------------------------------------------------
| WARDEN AUTH (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::prefix('warden')->group(function () {

    Route::get('/login',
        [WardenAuthController::class, 'showLogin']
    )->name('warden.login');

    Route::post('/login',
        [WardenAuthController::class, 'login']
    )->name('warden.login.submit');

    Route::post('/logout',
        [WardenAuthController::class, 'logout']
    )->name('warden.logout');
});

/*
|--------------------------------------------------------------------------
| WARDEN PANEL (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::prefix('warden')
    ->middleware('auth:warden')
    ->name('warden.')
    ->group(function () {

        Route::get('/dashboard',
            [WardenDashboardController::class, 'index']
        )->name('dashboard');

        Route::get('/students',
            [WardenStudentController::class, 'index']
        )->name('students.index');

        Route::get('/students/{student}',
            [WardenStudentController::class, 'show']
        )->name('students.show');

        Route::get('/students/{student}/history',
            [WardenStudentController::class, 'history']
        )->name('students.history');

        Route::post('/students/{student}/out',
            [RoomMovementController::class, 'out']
        )->name('students.out');

        Route::post('/students/{student}/in',
            [RoomMovementController::class, 'in']
        )->name('students.in');

        Route::get('/fees',
            [WardenFeeController::class, 'index']
        )->name('fees.index');

        Route::get('/fees/{student}',
            [WardenFeeController::class, 'show']
        )->name('fees.show');

        Route::get('/gate-passes',
            [GatePassController::class, 'index']
        )->name('gatepasses.index');

        Route::post('/gate-passes/{gatePass}/approve',
            [GatePassController::class, 'approve']
        )->name('gatepasses.approve');

        Route::post('/gate-passes/{gatePass}/reject',
            [GatePassController::class, 'reject']
        )->name('gatepasses.reject');
    });

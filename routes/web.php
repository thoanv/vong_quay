<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiemDanhController;
use App\Http\Controllers\SpinController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Ajax\AjaxController;
use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Admin\RewardController;
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
    return view('qr');
})->name('home');
Route::get('/diem-danh-thanh-cong/{attendance}', [DiemDanhController::class, 'show'])->name('success.attendance');
Route::get('/diem-danh', [DiemDanhController::class, 'index'])->name('attendance');
Route::post('/diem-danh', [DiemDanhController::class, 'store'])->name('post.attendance');
Route::get('/banh-xe', [SpinController::class, 'banhXe'])->name('banhXe');
Route::middleware(['auth'])->group(function () {
    Route::get('/quay', [SpinController::class, 'index'])->name('spin');
    Route::get('/reward', [SpinController::class, 'reward'])->name('reward');
    Route::get('/call-result', [SpinController::class, 'store'])->name('call-result');
    Route::post('/confirm-result', [SpinController::class, 'confirmResult'])->name('confirm-result');
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/information', [InformationController::class, 'edit'])->name('information.edit');
        Route::post('/information', [InformationController::class, 'update'])->name('information.update');
        Route::get('/rewards/{type}', [RewardController::class, 'index'])->name('rewards.type');
        Route::get('/rewards/list/create', [RewardController::class, 'create'])->name('rewards.list.create');
        Route::post('/rewards/remove/{reward}', [RewardController::class, 'remove'])->name('rewards.remove');
        Route::get('/thay-doi-mat-khau',[UserController::class, 'showChangePasswordGet'])->name('changePasswordGet');
        Route::post('/changePassword',[UserController::class, 'changePasswordPost'])->name('changePasswordPost');
        Route::post('/reset-password/{user}', [UserController::class , 'resetPassword'])->name('user.reset-pass');
        Route::resources([
            'departments'   => DepartmentController::class,
            'attendances'   => AttendanceController::class,
            'users'         => UserController::class,
            'rewards'       => RewardController::class,
        ]);
        Route::post('/remove-audio', [InformationController::class, 'removeAudio'])->name('remove-audio');
        Route::post('/delete-all-departments', [DepartmentController::class, 'deleteAll'])->name('delete-all-departments');
        Route::post('/delete-all-rewards', [RewardController::class, 'deleteAll'])->name('delete-all-rewards');
        Route::post('/status-departments/{type}', [DepartmentController::class, 'statusDepartment'])->name('status-departments');


        Route::post('/delete-all-attendances', [AttendanceController::class, 'deleteAll'])->name('delete-all-attendances');
        Route::post('/remove-winners', [AttendanceController::class, 'removeWinners'])->name('remove-winners');
        //Import database phòng ban
        Route::get('/import-view-departments', [DepartmentController::class, 'importView'])->name('import-view-departments');
        Route::post('/import-departments', [DepartmentController::class, 'import'])->name('import-departments');
    });
    //Ajax
    Route::post('enable-column', [AjaxController::class, 'enableColumn'])->name('enable-column');
    Route::post('enable-column-otp', [AjaxController::class, 'enableColumnOtp'])->name('enable-column-otp');
    Route::post('sort-reward', [AjaxController::class, 'sortReward'])->name('sort-reward');
});

require __DIR__.'/auth.php';

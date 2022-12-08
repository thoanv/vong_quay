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
Route::middleware(['auth'])->group(function () {
    Route::get('/quay', [SpinController::class, 'index'])->name('spin');
    Route::get('/call-result', [SpinController::class, 'store'])->name('call-result');
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/information', [InformationController::class, 'edit'])->name('information.edit');
        Route::post('/information', [InformationController::class, 'update'])->name('information.update');
        Route::resources([
            'departments'   => DepartmentController::class,
            'attendances'   => AttendanceController::class,
            'users'         => UserController::class,
        ]);
        Route::post('/delete-all-departments', [DepartmentController::class, 'deleteAll'])->name('delete-all-departments');
        Route::post('/status-departments/{type}', [DepartmentController::class, 'statusDepartment'])->name('status-departments');


        Route::post('/delete-all-attendances', [AttendanceController::class, 'deleteAll'])->name('delete-all-attendances');
        //Import database phòng ban
        Route::get('/import-view-departments', [DepartmentController::class, 'importView'])->name('import-view-departments');
        Route::post('/import-departments', [DepartmentController::class, 'import'])->name('import-departments');
    });
    //Ajax
    Route::post('enable-column', [AjaxController::class, 'enableColumn'])->name('enable-column');
});

require __DIR__.'/auth.php';

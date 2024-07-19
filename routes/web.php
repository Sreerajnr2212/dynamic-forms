<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\User\UserFormController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin');
});

Route::get('admin',[AuthController::class, 'login_admin'])->name('admin');
Route::post('admin',[AuthController::class, 'auth_login_admin']);
Route::get('admin/logout',[AuthController::class, 'admin_logout']);

Route::middleware('auth')->group(function(){
    Route::get('admin/form/add',[AdminController::class, 'add']);
    Route::get('admin/form/list',[FormController::class, 'index'])->name('form.list');
    Route::post('admin/form/save',[FormController::class, 'store'])->name('form.store');
    Route::get('admin/form/edit/{id}',[FormController::class, 'edit']);
    Route::post('admin/form/update/{id}',[FormController::class, 'update'])->name('form.update');
    Route::get('admin/form/delete/{id}',[FormController::class, 'delete']);
});
Route::get('users', [UserFormController::class, 'index'])->name('user_forms.list');
Route::get('users/form/{id}', [UserFormController::class, 'show'])->name('user_forms.show');
Route::post('users/formdata/save', [UserFormController::class, 'store'])->name('userform.store');






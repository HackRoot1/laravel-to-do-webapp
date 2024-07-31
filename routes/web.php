<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// })->name('login');

// Route::get('/register', function () {
//     return view('register');
// })->name('register');


Route::group(['prefix', 'account'], function() {

    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', [AccountController::class, 'login'])->name('account.login');
        Route::post('login', [AccountController::class, 'authenticate'])->name('account.authenticate');
        Route::get('register', [AccountController::class, 'register'])->name('account.register');
        Route::post('register', [AccountController::class, 'processRegister'])->name('account.processRegister');
        
    });
    
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', [AccountController::class, 'profile'])->name('account.profile');
        Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');
        Route::get('add-task', [AccountController::class, 'addTask'])->name('account.add.task');
        Route::get('view-task', [AccountController::class, 'viewTask'])->name('account.view.task');
        Route::get('check-task-done/{taskId}', [AccountController::class, 'makeTaskComplete'])->name('account.task.done');
        Route::get('delete-task/{taskId}', [AccountController::class, 'deleteTask'])->name('account.task.delete');
        Route::get('edit-task/{taskId}', [AccountController::class, 'editTask'])->name('account.task.edit');
        Route::post('add-task', [AccountController::class, 'addTaskData'])->name('account.add.task.data');
        Route::post('update-task', [AccountController::class, 'updateTaskData'])->name('account.update.task.data');
        Route::get('settings', [AccountController::class, 'settings'])->name('account.settings');
        Route::post('update-settings', [AccountController::class, 'updateSettings'])->name('account.update.settings');
    });


});
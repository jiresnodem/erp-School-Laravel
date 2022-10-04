<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\BackOffice\DashboardController;
use App\Http\Controllers\BackOffice\UserController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [AuthController::class, 'showLogin'])->name('showlogin');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/*manager user*/
route::prefix('/admin')->middleware(['auth', 'role:normal'])->group(
    function () {

        Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard');

//student

   Route::get('/student_list', [UserController::class, 'studentList'])->name('student.list');
   Route::get('/student_list', [UserController::class, 'studentList'])->name('student.list');
   Route::post('/student_created', [UserController::class, 'userStore'])->name('student.created');


       
       
       
       
       
       
        //manage user
        Route::get('/users_list', [UserController::class, 'UserList'])->name('user.list');

        Route::post('/user_created', [UserController::class, 'userStore'])->name('user.created');
        Route::get('/show_user/{id}', [UserController::class, 'showUser'])->name('show.user');
        Route::get('/user_edited/{id}', [UserController::class, 'editUser'])->name('user.edited');
        Route::get('/user_deleted/{id}', [UserController::class, 'DeleteUser'])->name('user.deleted');
        //user connected
        Route::get('/profile', [UserController::class, 'ProfileView'])->name('profile.View');




        Route::middleware(['role:admin'])->prefix('superAdmin')->group(function () {

            Route::get('/add_user', [UserController::class, 'UserAdd'])->name('add.user');
            Route::post('/update_user/{id}', [UserController::class, 'UpdateUser'])->name('update.user');
        });
    }
);

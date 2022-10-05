<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\BackOffice\DashboardController;
use App\Http\Controllers\BackOffice\UserController;
use App\Http\Controllers\BackOffice\TrainningController;
use App\Http\Controllers\BackOffice\StudentController;
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

        //mananger trainning
        Route::get('trainnings', [TrainningController::class, 'index'])->name('trainning.list');
        Route::get('trainning_create', [TrainningController::class, 'showCreate'])->name('trainning.create');
        Route::post('trainning_add', [TrainningController::class, 'trainningStore'])->name('trainning.add');
        Route::get('trainning_edit/{id}', [TrainningController::class, 'editTrainning'])->name('trainning.edit');
        Route::post('trainning_update/{id}', [TrainningController::class, 'UpdateTrainning'])->name('trainning.update');
        Route::get('trainning_delete/{id}', [TrainningController::class, 'delete'])->name('trainning.delete');
        Route::get('trainning_detail/{id}', [TrainningController::class, 'showTrainning'])->name('trainning.detail');

        //mananger student
        Route::get('students', [StudentController::class, 'index'])->name('student.list');
        Route::get('student_create', [StudentController::class, 'ShowRegistration'])->name('student.create');
        Route::post('student_add', [StudentController::class, 'studentStore'])->name('student.add');
        Route::get('student_edit/{id}', [StudentController::class, 'editStudent'])->name('student.edit');
        Route::post('student_update/{id}', [StudentController::class, 'UpdateStudent'])->name('student.update');
        Route::get('student_delete/{id}', [StudentController::class, 'deleteStudent'])->name('student.delete');
        Route::get('student_detail/{id}', [StudentController::class, 'showStudent'])->name('student.detail');





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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\BackOffice\UserController;
use App\Http\Controllers\BackOffice\BalanceController;
use App\Http\Controllers\BackOffice\ExpenseController;
use App\Http\Controllers\BackOffice\PaymentController;
use App\Http\Controllers\BackOffice\StudentController;
use App\Http\Controllers\BackOffice\DashboardController;
use App\Http\Controllers\BackOffice\TrainningController;

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
        Route::get('student_create', [StudentController::class, 'showRegistration'])->name('student.create');
        Route::post('student_add', [StudentController::class, 'studentStore'])->name('student.add');
        Route::get('student_edit/{id}', [StudentController::class, 'editStudent'])->name('student.edit');
        Route::post('student_update/{id}', [StudentController::class, 'updateStudent'])->name('student.update');
        Route::get('student_delete/{id}', [StudentController::class, 'deleteStudent'])->name('student.delete');
        Route::get('student_detail/{id}', [StudentController::class, 'showStudent'])->name('student.detail');


        //mananger payment
        Route::get('payments', [PaymentController::class, 'index'])->name('payment.list');
        Route::get('payment_create', [PaymentController::class, 'createPayment'])->name('payment.create');
        Route::get('payment_type', [PaymentController::class, 'searchPaymentType'])->name('payment.type');
        Route::post('payment_add', [PaymentController::class, 'paymentStore'])->name('payment.add');
        Route::get('payment_delete/{id}', [PaymentController::class, 'deletePayment'])->name('payment.delete');
        Route::get('payment_show/{id}', [PaymentController::class, 'showPayment'])->name('payment.show');


        //mananger expenses
        Route::get('expenses', [ExpenseController::class, 'index'])->name('expense.list');
        Route::get('expense_create', [ExpenseController::class, 'createExpense'])->name('expense.create');
        Route::post('expense_add', [ExpenseController::class, 'expenseStore'])->name('expense.add');
        Route::get('expense_edit/{id}', [ExpenseController::class, 'editExpense'])->name('expense.edit');
        Route::post('expense_update/{id}', [ExpenseController::class, 'updateExpense'])->name('expense.update');
        Route::get('expense_delete/{id}', [ExpenseController::class, 'deleteExpense'])->name('expense.delete');
        Route::get('expense_show/{id}', [ExpenseController::class, 'showExpense'])->name('expense.show');


        //mananger balance
        Route::get('balance', [BalanceController::class, 'index'])->name('balance.list');
        Route::get('balance_delete', [BalanceController::class, 'deleteBalance'])->name('balance.delete');


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

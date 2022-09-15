<?php

use App\Http\Controllers\EmployeeController;
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


Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');

Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::post('/update', [EmployeeController::class, 'update'])->name('employee.update');
// When an incoming request matches the specified route URI, the "update" method on the App\Http\Controllers\EmployeeController class will be invoked and the route parameters will be passed to the method.

Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');


Route::get('/employeeList', [EmployeeController::class, 'employeeList'])->name('employee.employeeList');
Route::get('/employeeList/{id}', [EmployeeController::class, 'employeeListEdit'])->name('employee.employeeList.edit');



// These routes where specificaly created for soft deleting
Route::get('/restore/{id}', [EmployeeController::class, 'restore'])->name('employee.restore');
Route::get('/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');



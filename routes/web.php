<?php

use App\Http\Controllers\TaskController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [TaskController::class, "index"])->name('home');

Route::get('/form', [TaskController::class , "create"])->name('tasks.formTask');

Route::post('/tasks/send', [TaskController::class, "store"])->name('tasks.sendMessage');

Route::get('/tasks/{id}/edit', [TaskController::class, "edit"])->name('tasks.edit');
Route::patch('/tasks/{id}', [TaskController::class, "update"])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, "destroy"])->name('tasks.delete');





Route::get('/send-notification', [UserController::class, 'sendNotification']);
Route::get('/notification', [UserController::class, 'showNotification']);

//Route::resource('/users',\App\Http\Controllers\UserController::class);

Route::get('/users', [Usercontroller::class, 'index']);



// Route::post('/form', function () {
// dd(request()->all());
// \App\Jobs\MailNewUser::dispatch(request('name'));
//    event(new \App\Events\RegisterdUser(request('name')));
// })->name('form');




Route::get('/excel', [UserController::class, 'excelExport'])->name('excel.import');
Route::post('/excel', [UserController::class, 'excelImport'])->name('excel.import');

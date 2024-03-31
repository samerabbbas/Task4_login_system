<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeCpntroller;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('welcome');
})->name('home.welcome');

//.........Admin Route...................
//employee table page 
Route::get('/employee', [adminController::class,'index'])->name('admin.index');
//store data(create page)
Route::post('/employee',[AdminController::class,'store'])->name('admin.store')->middleware('storEmployee');
//Creat New employee
Route::get('/employee/creat',[AdminController::class,'create'])->name('admin.create');

//Read More
Route::get('/employee/{employee}',[AdminController::class,'show'])->name('admin.show');
//Edit 
Route::get('/employee/{employee}/edit',[AdminController::class,'edit'])->name('admin.edit');
//update Database Record
Route::put('/employee/{employee}',[AdminController::class,'update'])->name('admin.update')->middleware('storEmployee');
//Delete Database Record
Route::delete('/employee/{employee}',[AdminController::class,'destroy'])->name('admin.destroy');

//Creat New Admin
Route::get('/admin/creat',[AdminController::class,'create_Admin'])->name('admin.createAdmin');
//Add the new Admin To dataBase (take action from Registor controller)
Route::post('/admin/store',[AdminController::class,'stroe_Admin'])->name('admin.storeAdmin')->middleware('adminValdate');

//Edit Admin
Route::get('/admin/{user}/edit',[AdminController::class,'edit_Admin'])->name('admin.editAdmin');
Route::put('/admin/{user}',[AdminController::class,'update_Admin'])->name('admin.updateAdmin')->middleware('editAdmin');
//Delete Admin
Route::delete('/admin/{user}',[AdminController::class,'destroy_Admin'])->name('admin.destroyAdmin');
//search a Employee
Route::post('/admin/search',[AdminController::class,'showMulti'])->name('admin.showMulti');

//....................User Rout......................
//user Table
Route::get('/user', [UserController::class,'index'])->name('user.index');
//show sigle user data
Route::get('/user/{user}',[UserController::class,'show'])->name('user.show');
//search a Employee
Route::post('/user/search',[UserController::class,'showMulti'])->name('user.showMulti');

//......................login/logout/home route............
Auth::routes();
//home page
Route::get('/home', [HomeController::class, 'index'])->name('home');
//logout rout
Route::post('/logout', [HomeController::class, 'logout'])->name('home.logout');
//login rout
Route::post('/home/checklogin', [HomeController::class, 'login'])->name('home.login')->middleware('hasPermission');
//home to admin or user page route
Route::get('/app/login', [HomeController::class, 'app_login'])->name('app.login') ->middleware('isAdmin');
//Route::post('/main/checklogin', 'MainController@checklogin');
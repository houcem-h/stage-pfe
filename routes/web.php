<?php

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
    return view('welcome');
});



// Adem Routes //

//dashboard
Route::get('/dashboard', function () {
    return View('dashboards.admin.dash');
})->middleware("auth")->name('dash');

//login
Route::get('/connect', function () {
    return View('dashboards.admin.login');
})->name('connect');

/************* USERS **************/

//all users
Route::get('/dashboard/Users/All', function () {
    return View('dashboards.admin.allusers');
})->name('Allusers');

//only students
Route::get('/dashboard/Users/Students', function () {
    return View('dashboards.admin.students');
})->name('students');

//only teachers
Route::get('/dashboard/Users/Teachers', function () {
    return View('dashboards.admin.teachers');
})->name('teachers');

//only admins
Route::get('/dashboard/Users/Admins', function () {
    return View('dashboards.admin.admins');
})->name('admins');




/************* Interships **************/

//All Interships
Route::get('/dashboard/Interships/all', function () {
    return View('dashboards.admin.interships_all');
})->name('interships_all');

//Initiation
Route::get('/dashboard/Interships/init', function () {
    return View('dashboards.admin.interships_init');
})->name('interships_init');

//Perfectionnement
Route::get('/dashboard/Interships/perf', function () {
    return View('dashboards.admin.interships_perf');
})->name('interships_perf');

//PFE
Route::get('/dashboard/Interships/pfe', function () {
    return View('dashboards.admin.interships_pfe');
})->name('interships_pfe');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Adem Routes //


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



//********************************************* Routes by Adem-kk *************************************//

//********dashboard
Route::get('/dashboard', function () {
    return View('dashboards.admin.dash');
})->middleware("auth")->name('dash');

//********login
Route::get('/connect', function () {
    return View('dashboards.admin.login');
})->name('connect');

/************* USERS **************/

//*****all users
Route::get('/dashboard/Users/All', function () {
    return View('dashboards.admin.allusers');
})->name('Allusers');

//*****only students
Route::get('/dashboard/Users/Students', function () {
    return View('dashboards.admin.students');
})->name('students');

//*****only teachers
Route::get('/dashboard/Users/Teachers', function () {
    return View('dashboards.admin.teachers');
})->name('teachers');

//*****only admins
Route::get('/dashboard/Users/Admins', function () {
    return View('dashboards.admin.admins');
})->name('admins');




/************* Interships **************/

//*******All Interships
Route::get('/dashboard/Interships/all', function () {
    return View('dashboards.admin.interships_all');
})->name('interships_all');

//*******Initiation
Route::get('/dashboard/Interships/init', function () {
    return View('dashboards.admin.interships_init');
})->name('interships_init');

//*******Perfectionnement
Route::get('/dashboard/Interships/perf', function () {
    return View('dashboards.admin.interships_perf');
})->name('interships_perf');

//*******PFE
Route::get('/dashboard/Interships/pfe', function () {
    return View('dashboards.admin.interships_pfe');
})->name('interships_pfe');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//******************************************End of Routes by Adem-kk *************************************************//



/******************************************** ROUTES BY AMINE BEJAOUI ***************************************************/
/******* route group-admin *******/
//GET
Route::get('/group',"groupsController@index")->name('group');
Route::get("Show_blade_update/{id}","groupsController@showFormUpdate");
Route::get("Show_blade_delete/{id}","groupsController@showFormDelete");
Route::get('show_blade_add',"groupsController@showFormAdd")->name("show_blade_add");



//post (AJAX)
Route::post('saveUpdateGroup',"groupsController@saveUpdateGroup")->name("saveUpdateGroup");
Route::post('saveDeleteGroup/{id}',"groupsController@saveDeleteGroup")->name("saveDeleteGroup");
Route::post('add_group',"groupsController@add_group")->name("add_group");
Route::post('check_group','groupsController@check_group')->name("check_group");
Route::post("get_students","groupsController@get_students")->name("get_students"); //for group


/******* route student-admin *******/
//GET
Route::get("show_students","studentsController@show_students")->name("show_all_students");
Route::get("Show_blade_update_student/{id}","studentsController@show_update")->name("Show_blade_update_student");

//post (AJAX)
Route::post("check_group_name","studentsController@check_groupName")->name("check_group_name");
Route::post("get_group_name","studentsController@get_groupName")->name("get_group_name");
//post (form)
Route::post("save_updates/{id}","studentsController@save_updates")->name("save_updates");
Route::post("update_Students_Group","studentsController@save_updated_group")->name("update_Students_Group");
/******************************************** END OF ROUTES BY AMINE BEJAOUI ***************************************************/


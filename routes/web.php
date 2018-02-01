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
    $allusers =  \App\User::orderBy('created_at')->paginate(10);   
    return View('dashboards.admin.allusers', ['allusers' => $allusers]);})->name('Allusers');

//*****only students
Route::get('/dashboard/Users/Students', function () {
    $allstudents =  Illuminate\Support\Facades\DB::table("users")->where('role', '=', '0')->paginate(10);
    return View('dashboards.admin.students', ['allstudents' => $allstudents]);})->name('students');

//*****only teachers
Route::get('/dashboard/Users/Teachers', function () {
    $allteachers =  Illuminate\Support\Facades\DB::table("users")->where('role', '=', '1')->paginate(10);
    return View('dashboards.admin.teachers', ['allteachers' => $allteachers]);})->name('teachers_list');

//*****only admins
Route::get('/dashboard/Users/Admins', function () {
    $alladmins =  Illuminate\Support\Facades\DB::table("users")->where('role', '=', '2')->paginate(10);
    return View('dashboards.admin.admins',  ['alladmins' => $alladmins]);})->name('admins');

//**Recherche Utilisateur */
Route::get('/dashboard/Users/Search/{query}', function($query) {
    $result = App\User::SearchByKeyword($query)->get();    
    return View('dashboards.admin.search', ['result' => $result]);
});


//test pdf

Route::get('/dashboard/UpgradeUser', 'GetStat@upgrade_teacher');
Route::get('/upgrade_by_id/{id}' , 'GetStat@upgrade_by_id');
Route::get('/dashboard/pdf/soutenances', 'GetStat@pdf_calendar');



/** Ajax Delete User from Dashboard as admin */
Route::get('/deleteuser/{id}' , 'GetStat@destroyuser');

/** Test */
Route::get('/getuserinfo/{id}' , 'GetStat@getuserdata');

/** Ajax Update Users Info */
Route::post('/updateuser' , 'GetStat@updateinfousers');


Route::get('dashboard/Companies', function() {
    $allcompanies = Illuminate\Support\Facades\DB::table("companies")->get();
    return View('dashboards.admin.companies' , ['companies' => $allcompanies]);
});



/************* Mailer **************/

//** Mail to students */
Route::get('/dashboard/Mailer', 'sendmail@index')->name('Mailer');
// (Ajax) Send emails
Route::post('/sendmail', 'sendmail@send');

/************* Reports **************/

//**** Get list of students as PDF ****/
Route::get('/pdf/students', "GetStat@ExportStudentsAsPDF")->middleware("auth")->name('studentspdf');
//**** Get list of Teachers as PDF ****/
Route::get('/pdf/teachers', "GetStat@ExportTeachersAsPDF")->middleware("auth")->name('teacherspdf');
//*** Get list of students as Excel ***/
Route::get('/excel/students', 'GetStat@ExportStudentsAsExcel')->middleware("auth")->name('studentsxls');
//*** Get list of teachers as Excel ***/
Route::get('/excel/teachers', 'GetStat@ExportTeachersAsExcel')->middleware("auth")->name('teachersxls');
Route::get('/dashboard/reports', 'GetStat@showResultPage');


Route::get('/dashboard/pdf/affectation/{date}', 'GetStat@testingPDF' );
Route::get('/dashboard/pdf/invit/{date}', 'GetStat@invitation' );


/************* Interships **************/

//*******All Interships
Route::get('/pdf/{teacher_type}/{year}/{type}/{teacher_name}','GetStat@get_teachers_data_pdf');


Route::get('/dashboard/Interships/all', 'GetStat@internships_all')->name('interships_all');
Route::get('/dashboard/Interships/init', 'GetStat@internships_init')->name('interships_init');
Route::get('/dashboard/Interships/perf', 'GetStat@internships_perf')->name('interships_perf');
Route::get('/dashboard/Interships/pfe', 'GetStat@internships_pfe')->name('interships_pfe');


Route::get('/dashboard/Requests', function() {
    $allwaitingUsers = Illuminate\Support\Facades\DB::table("users")->where("state" , '=' , "waiting")->get();
    return View('dashboards.admin.acceptReq', ['Allwaiting' => $allwaitingUsers]);
})->name('Requests');


// Accept & reject users by id (only one user per operation)
Route::get('/AcceptUser/{id}' , 'GetStat@AcceptSingleUser');
Route::get('/RejectUser/{id}' , 'GetStat@RejectSingleUser');

Route::post('/AcceptUsers' , 'GetStat@AcceptSelectedUser');
Route::post('/RejectUsers' , 'GetStat@RejectSelectedUser');

//test
Route::get('/dashboard/defenses/all', 'GetStat@soutenance_all')->name('defences_all');
Route::get('/dashboard/defenses/accepted', 'GetStat@soutenance_accepted')->name('defences_accepted');
Route::get('/dashboard/defenses/waiting', 'GetStat@soutenance_waiting')->name('defences_waiting');
Route::get('/dashboard/defenses/rejected', 'GetStat@soutenance_rejected')->name('defences_rejected');


//PDF (get by year - type - note)
Route::get('/pdf/reports_1/{year}/{egal}/{type}/{note}' , 'GetStat@get_defenses_with_note'); 


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


// ***************************  Routes Oussama  **********************************

// ***************************  Routes Oussama  **********************************

    Route::resource('/company','CompaniesController');
    Route::resource('/companiesmanagers','CompaniesManagersController');

    Route::group(['middleware'=>['auth']],function(){
        Route::get('/studentdashboard','PagesController@studentDashboard');
        Route::get('/ordinaryteacherdashboard','PagesController@ordinaryTeacherDashboard');
        Route::get('/managerteacherdashboard','PagesController@managerTeacherDashboard');
    });

    Route::get('/internships','InternShipsController@index');
    Route::get('/internships/create','InternShipsController@create');
    Route::get('/internships/{id}','InternShipsController@show')->where('id','[0-9]+')->name('showinternship');
    Route::get('/internships/{id}/edit','InternshipsController@edit');
    Route::post('/internships/store','InternshipsController@store');
    Route::put('/internships/update/{id}','InternshipsController@update')->where('id','[0-9]+');




/************************************************ Hazem's Route ************************************************/


Route::get('teachers_list', 'TeachersController@index')->name("teachers");
Route::get('dashboard/{id}/acc', 'DashboardsController@acc');
Route::get('dashboard/{id}/ref', 'DashboardsController@ref');
Route::get('dashboard/{id}/encadre', 'DashboardsController@encadre');
Route::get('settings', 'DashboardsController@settings')->name("settings");
Route::get('teacherhome','DashboardsController@index')->name("teacherhome");
Route::get("updatepass","DashboardsController@updatepass")->name("updateinfo");
Route::post("internsinfo","groupController@internsinfo")->name("internsinfo"); //for group

Route::resource('teachers','TeachersController');

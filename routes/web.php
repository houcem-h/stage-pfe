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

Route::get('a_propos', function() {
    return View('CustomAuth.apropos');
})->name('a_propos');

Route::get('/dashboard/soutenances_cette_annee' , 'GetStat@soutenance_cette_annee')->name('soutenance_cette_annee');
Route::get('/dashboard/soutenances_historique' , 'GetStat@soutenance_historique')->name('soutenance_historique');
Route::get('/dashboard/soutenances_historique/{years}' , 'GetStat@soutenance_historique_by_years');
Route::get('/dashboard/pdf/soutenance/{id}' , 'GetStat@soutenance_pdf_id');
Route::get('/dashboard/encadrement_waiting', 'GetStat@encadrement_waiting')->name('encadrement_waiting');
Route::get('/dashboard/encadrement_accepted', 'GetStat@encadrement_accepted')->name('encadrement_accepted');
Route::get('/dashboard/encadrement_rejected', 'GetStat@encadrement_rejected')->name('encadrement_rejected');
/** (Ajax) get frame_req data for modal */
Route::get('frame_req/{id}' , 'GetStat@getframingreq_by_id');
Route::get('frame_accept/{id}' , 'GetStat@accept_framing');
Route::get('frame_reject/{id}' , 'GetStat@reject_framing');
Route::get('frame_waiting/{id}' , 'GetStat@waiting_framing');
Route::get('/jobs' , 'GetStat@get_jobs_nb')->name('jobscount');

//********************************************* Routes by Adem-kk *************************************//

Route::get("/",function(){ return view("welcome"); });
//** Dashboard
Route::get('/dashboard', function () {return View('dashboards.admin.dash');})->middleware("auth")->name('dash');
//** Login
Route::get('/connect', function () { return View('dashboards.admin.login');})->name('connect');

/************* USERS **************/
//***** All users
Route::get('/dashboard/Users/All', function () {
    $allusers =  \App\User::orderBy('created_at')->paginate(10);
    return View('dashboards.admin.allusers', ['allusers' => $allusers]);})->name('Allusers');

//*****Only students
Route::get('/dashboard/Users/Students', function () {
    $allstudents =  Illuminate\Support\Facades\DB::table("users")->where('role', '=', '0')->paginate(10);
    return View('dashboards.admin.students', ['allstudents' => $allstudents]);})->name('students');

//*****Only teachers
Route::get('/dashboard/Users/Teachers', function () {
    $allteachers =  Illuminate\Support\Facades\DB::table("users")->where('role', '=', '1')->paginate(10);
    return View('dashboards.admin.teachers', ['allteachers' => $allteachers]);})->name('teachers_list');

//*****only Admins
Route::get('/dashboard/Users/Admins', function () {
    $alladmins =  Illuminate\Support\Facades\DB::table("users")->where('role', '=', '2')->paginate(10);
    return View('dashboards.admin.admins',  ['alladmins' => $alladmins]);})->name('admins');

//**Recherche Utilisateur */
Route::get('/dashboard/Users/Search/{query}', function($query) {
    $result = App\User::SearchByKeyword($query)->get();
    return View('dashboards.admin.search', ['result' => $result]);
});
//added by amine (Les invitations)
Route::get('/dashboard/studentInvitations', "Admin\dashboardController@showStudentInvit");
Route::get('/dashboard/teacherInvitations', "Admin\dashboardController@showTeacherInvit");

// upgrade + pdf
Route::get('/dashboard/UpgradeUser', 'GetStat@upgrade_teacher');
Route::get('/upgrade_by_id/{id}' , 'GetStat@upgrade_by_id');
Route::get('/downgrade_by_id/{id}' , 'GetStat@downgrade_by_id');															
Route::get('/dashboard/pdf/soutenances', 'GetStat@pdf_calendar');

/** Ajax Delete User from Dashboard as admin */
Route::get('/deleteuser/{id}' , 'GetStat@destroyuser');
/** Test */
Route::get('/getuserinfo/{id}' , 'GetStat@getuserdata')->name('getuserinfo');
/** Ajax Update Users Info */
Route::post('/updateuser' , 'GetStat@updateinfousers');
Route::get('dashboard/Companies', function() {
    $allcompanies = Illuminate\Support\Facades\DB::table("companies")->get();
    return View('dashboards.admin.companies' , ['companies' => $allcompanies]);
})->name('companies');
Route::get('/test', 'GetStat@getalldefences');

/************* Mailer **************/
//** Mail to students */
Route::get('/dashboard/Mailer', 'sendmail@index')->name('Mailer');
// (Ajax) Send emails
Route::post('/sendmail', 'sendmail@send');
/************* Reports **************/

//**** Get list of students as PDF ****/
Route::get('/pdf/students', "GetStat@ExportStudentsAsPDF")->middleware("auth")->name('studentspdf');
Route::get('/pdf/teachers', "GetStat@ExportTeachersAsPDF")->middleware("auth")->name('teacherspdf');
Route::get('/excel/students', 'GetStat@ExportStudentsAsExcel')->middleware("auth")->name('studentsxls');
Route::get('/excel/teachers', 'GetStat@ExportTeachersAsExcel')->middleware("auth")->name('teachersxls');
Route::get('/dashboard/reports', 'GetStat@showResultPage')->name("reports");
Route::get('/dashboard/pdf/affectation/{date}', 'GetStat@testingPDF' );
Route::get('/dashboard/pdf/invit/{date}', 'GetStat@invitation' );
Route::get('/dashboard/pdf/affectation/{date}', 'GetStat@testingPDF' );
Route::get('/dashboard/pdf/invit/{date}', 'GetStat@invitation' );
Route::get('/pdf/reports_1/{year}/{egal}/{type}/{note}' , 'GetStat@get_defenses_with_note'); 


/************* Interships **************/

//*******All Interships
Route::get('/dashboard/Interships/all', 'GetStat@internships_all')->name('interships_all');
Route::get('/dashboard/Interships/init', 'GetStat@internships_init')->name('interships_init');
Route::get('/dashboard/Interships/perf', 'GetStat@internships_perf')->name('interships_perf');
Route::get('/dashboard/Interships/pfe', 'GetStat@internships_pfe')->name('interships_pfe');
//**defences */
Route::get('/dashboard/defenses/all', 'GetStat@soutenance_all')->name('defences_all');
Route::get('/dashboard/defenses/accepted', 'GetStat@soutenance_accepted')->name('defences_accepted');
Route::get('/dashboard/defenses/waiting', 'GetStat@soutenance_waiting')->name('defences_waiting');
Route::get('/dashboard/defenses/rejected', 'GetStat@soutenance_rejected')->name('defences_rejected');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//******************************************End of Routes by Adem-kk *************************************************//



/******************************************** ROUTES BY AMINE BEJAOUI ***************************************************/
/******* route group-admin *******/
Route::group(["middleware"=>"auth"],function(){
//GET
Route::get('/group',"Admin\groupsController@index")->name('group');
Route::get("Show_blade_update/{id}","Admin\groupsController@showFormUpdate")->name('Show_blade_update');
Route::get('show_blade_add',"Admin\groupsController@showFormAdd")->name("show_blade_add");
//post (AJAX)
Route::post('saveUpdateGroup',"Admin\groupsController@saveUpdateGroup")->name("saveUpdateGroup");
Route::post('add_group',"Admin\groupsController@add_group");
Route::post('check_group','Admin\groupsController@check_group');
Route::post("get_students","Admin\groupsController@get_students");



/******* route student-admin *******/
//GET
Route::get("show_students","Admin\studentsController@show_students")->name("show_all_students");
Route::get("Show_blade_update_student/{id}","Admin\studentsController@show_update")->name("Show_blade_update_student");
Route::get("AddStudent","Admin\studentsController@show_add_student")->name("add_student");
//post (AJAX)
Route::post("check_group_name","Admin\studentsController@check_groupName");
Route::post("get_group_name","Admin\studentsController@get_groupName");
//post (form)
Route::post("save_updates/{id}","Admin\studentsController@save_updates")->name("save_updates");
Route::post("update_Students_Group","Admin\studentsController@save_updated_group")->name("update_Students_Group");
Route::post('save_added_student',"Admin\studentsController@save_added_student")->name("save_added_student");
/************ route inviation account ************/

Route::post("/dashboard/acceptStudent","Admin\dashboardController@acceptInvitations");
Route::post("/dashboard/deleteStudent","Admin\dashboardController@deleteStudent");

Route::post("/dashboard/acceptTeacher","Admin\dashboardController@acceptInvitationsTeacher");
Route::post("/dashboard/deleteTeacher","Admin\dashboardController@deleteTeacher");
});

/************STUDENT ROOT**************/
Route::group(["middleware"=>["auth"]],function(){
//get
Route::get('student/settings/profile',"Students\studentsController@show_edit_profile")->name("edit_profile");
Route::get("student/settings/email","Students\studentsController@show_edit_email")->name("edit_email");
Route::get("student/settings/password","Students\studentsController@show_edit_password")->name("edit_password");
Route::get("student/settings/{url_with_token}","Students\studentsController@show_newEmail_form")->name("show_newEmail_form");
Route::get("student/dashboard","Students\studentsController@show_dashboard")->name("dashboard_student");
Route::get("student/informations","Students\studentsController@display_informations")->name("display_informations");
Route::get("student/demande","Students\studentsController@demande")->name("demande_stage");
Route::get("student/notifications","Students\studentsController@displayNotification")->name("Notification");
Route::get("student/showAllTeachers", "Students\studentsController@display_teacher")->name("showAllTeachers");
Route::get("student/history","Students\studentsController@show_history")->name("history");
//POST
Route::post("student_save_info","Students\studentsController@save_informations")->name("student_save_info");
Route::post("email_config","Students\studentsController@send_email")->name("send_email");
//ajax
Route::post("editPassword","Students\studentsController@edit_pass")->name("editPassword");
Route::post("submit_newEmail","Students\studentsController@save_newEmail")->name("submit_newEmail");
Route::post("student/NotifyMe","Students\studentsController@Notifications");
Route::post("student/acceptDemande","Students\studentsController@acceptDemande");
Route::post("student/rejectDemande","Students\studentsController@rejectDemande");
});





//custom login
Route::get('/login',function(){
    return view('CustomAuth.login');
})->name("connecter");

Route::get('/signinStudent',function(){
    $groups = App\Group::get(['name',"id"]);
    return view('CustomAuth.registerStudent')->with("groups",$groups);
})->name("creerEtudiant");

Route::get('/signinTeacher',function(){
    return view('CustomAuth.registerTeacher');
})->name("creerEnseignant");


Route::get("/role",function(){
    return view("CustomAuth.selectRole");
})->name("chooseRole");

Route::get("/reset",function(){
    return view("CustomAuth.resetPassword");
})->name("reset");


Route::get("/confirm",function(){
    return view("CustomAuth.PasswordCodeReset");
})->name("PasswordCodeReset");


////FOR REGISTER
Route::post("RegisterCheckEmail","customAuth\customAuthregister@checkEmailExist");
Route::post("RegistercheckCin","customAuth\customAuthregister@checkCinExist");
Route::post("registerAccount","customAuth\customAuthregister@registerStudent");
Route::post("registerAccountTeacher","customAuth\customAuthregister@registersTeacher");

Route::post("getNameGroup","customAuth\customAuthregister@getNameGroup");
// For login
Route::post("EmailExist","customAuth\customAuthLogin@checkEmailExist");
Route::post("checkConnection","customAuth\customAuthLogin@checkConnection");
//For reset password
Route::post("sendCode","customAuth\customAuthReset@sendCode")->name("sendCodeReset");
Route::post("FinalResetPassword","customAuth\customAuthReset@StoreNewPassword");
/******************************************** END OF ROUTES BY AMINE BEJAOUI ***************************************************/


// ***************************  Routes Oussama  **********************************
  Route::resource('/company','CompaniesController');
    Route::resource('/companiesmanagers','CompaniesManagersController');
    Route::resource('/specifications','SpecificationsController');
    Route::resource('/planning','PlanningController');
    Route::post('/planninggetrestrictions','PlanningController@restrictions');
    Route::group(['middleware'=>['auth']],function(){

        //Pour oussema, route dashboard, fi route mte3i  ;)
        Route::get('/studentdashboard','PagesController@studentDashboard');
         Route::get('/teacherhome','DashboardsController@index')->name("teacherhome");
        Route::get('/managerteacherdashboard','PagesController@managerTeacherDashboard');
    });
    Route::post('/internshipsave','InternShipsController@storeInternshipDemand');
    Route::get('/internshipdemand','InternShipsController@dynamicViewInternshipDemand');
    Route::get('/internships','InternShipsController@index');
    Route::get('/internships/create','InternShipsController@create');
    Route::get('/internships/{id}','InternShipsController@show')->where('id','[0-9]+')->name('showinternship');
    Route::get('/internships/{id}/edit','InternshipsController@edit');
    Route::post('/internships/store','InternshipsController@store');
    Route::put('/internships/update/{id}','InternshipsController@update')->where('id','[0-9]+');
    Route::post('/pferestrictions','PlanningController@pfeRestrictions');
    Route::post('/planningpfe','PlanningController@pfePlanningStore');
    Route::get('/showpfeplanning','PlanningController@showPFEPlanning');
    Route::get('/planningpfe',function(){
        return view('planning.pfeplanning');
    })->middleware('AdminAccessRights');
/************************************************ Hazem's Route ************************************************/



/************************************************ Hazem's Route ************************************************/


Route::get('teachers_list', 'TeachersController@index')->name("teachers");
Route::get('dashboard/{id}/acc', 'DashboardsController@acc');
Route::get('dashboard/{id}/ref', 'DashboardsController@ref');
Route::get('dashboard/{id}/encadre', 'DashboardsController@encadre');
Route::get("calendar","DashboardsController@calendar")->name("calendar");
Route::get('settings', 'DashboardsController@settings')->name("settings");
Route::get('settingspass', 'DashboardsController@settingspass')->name("settingspass");
Route::get('teacherhome','DashboardsController@index')->name("teacherhome");
Route::get("teacherhome/{id}/info","DashboardsController@info");
Route::get("information/{id}","DashboardsController@information")->name("information");
Route::get('dashboard/Calendarsoutenances', 'DashboardsController@pdf_defensescalendar')->name("soutenancespdf");
Route::resource('teachers','TeachersController');
Route::post("editPasswordteacher","DashboardsController@edit_pass")->name("editPasswordteacher");




Route::post("/login","Auth\LoginController@login")->name("login");

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\Mail2Students;
class sendmail extends Controller
{
    public function index() {
       // $userlist = DB::table('users')->Paginate(10);
        $userlist = User::all();
        return View('dashboards.admin.mailtouserlist', ['userlist' => $userlist]);
    }



    public function send(Request $request){

        $mytext = $request['mytext'];    

        $emails = $request->only(['emails']);
        $emailstring = $emails["emails"]; 
        $emailstring = str_replace('[', '', $emailstring);
        $emailstring = str_replace(']', '', $emailstring);    
        $emailstring = str_replace('"', '', $emailstring);
        $emailarray  = explode(",", $emailstring);

        foreach( $emailarray as $em) {
            \Mail::to($em)->send(new Mail2Students($mytext));  
        }
        return "true";
    }




}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisterController;
use App\User;


class TeachersController extends Controller
{


  public function __construct(){
    $this->middleware('TeachersAccessRights')->only('update');
    $this->middleware('AdminAccessRights')->except('update');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          //fetch query
      $teachers = DB::table('users')
        ->where('role', 1)
        ->orderBy('firstname','asc')->get();
        return view('teachers.all')->with('teachers', $teachers) ;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validatin field


      $this->validate($request, [
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'required',
          'phone' => 'required',
          'cin' => 'required',

      ]);

        //add teacher
        $teacher =new User;
        $teacher->firstname = $request->input('firstname');
        $teacher->lastname = $request->input('lastname');
        $teacher->email = $request->input('email');
        $teacher->phone = $request->input('phone');
        $teacher->birthdate = $request->input('birthdate');
        $teacher->cin = $request->input('cin');
        $teacher->password  = bcrypt($request->input('cin'));
        $teacher->role = $request->input('role');
        $teacher->save();
        return view('/teachers');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $teacher = User::find($id);
      return view('teachers.show')->with('teacher',$teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
   {
       $teacher = User::find($id);
       return view('teachers.edit')->with('teacher',$teacher);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {

     $this->validate($request, [
         'firstname' => 'required',
         'lastname' => 'required',
         'email' => 'required',
         'phone' => 'required',
         'birthdate' => 'nullable',
         'cin' => 'nullable',
         'role' => 'nullable'
     ]);

       //update teacher
       $teacher = User::find($id);
       $teacher->firstname = $request->input('firstname');
       $teacher->lastname = $request->input('lastname');
       $teacher->email = $request->input('email');
       $teacher->phone = $request->input('phone');
       $teacher->birthdate = $request->input('birthdate');
       $teacher->cin = $request->input('cin');
       $teacher->role = $request->input('role');
       $teacher->save();
       if ($request->input('role')==null) {
         $teacher->role =1;
         $teacher->save();
         return redirect('teacherhome')->with('success','information mis à jour');

       }else {

         $teacher->role = $request->input('role');
         $teacher->save();
         return redirect('teachers')->with('success','Enseignant mis à jour');

       }

   }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {

         $teacher = User::find($id);
         $teacher->delete();

          return redirect('/teachers');
     }




}

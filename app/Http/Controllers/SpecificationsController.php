<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Specification;
use Illuminate\Support\Facades\Session;
class SpecificationsController extends Controller
{

     public function __construct(){
         $this->middleware('auth');
         $this->middleware('IntershipsAccessRights');
         $this->middleware('VerifyPreviousLocation')->only('edit');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specifications=Specification::paginate(10);
        return view('specifications.index')->with('specifications',$specifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'title'=>'max:189|required',
           'project_type'=>'max:189|required',
           'existing_desc'=>'max:189|required',
           'requirement_spec'=>'max:189|required',
           'hardware_env'=>'max:189|required',
           'software_env'=>'max:189|required',
           'provisional_planning'=>'max:500|required'
        ]);

         $specification=new Specification();
         $specification->title=$request->input('title');
         $specification->project_type=$request->input('project_type');
         $specification->existing_desc=$request->input('existing_desc');
         $specification->requirement_spec=$request->input('requirement_spec');
         $specification->hardware_env=$request->input('hardware_env');
         $specification->software_env=$request->input('software_env');
         $specification->provisional_planning=$request->input('provisional_planning');
         $specification->created_by=auth()->user()->id;
         if($specification->save())
           return redirect('/specifications')->with('success','specification created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specification=Specification::find($id);
        return view('specifications.show')->with('spec',$specification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specification=Specification::find($id);
       return view('specifications.edit')->with('specification',$specification);
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
        $this->validate($request,[
           'title'=>'max:189|required',
           'project_type'=>'max:189|required',
           'existing_desc'=>'max:189|required',
           'requirement_spec'=>'max:189|required',
           'hardware_env'=>'max:189|required',
           'software_env'=>'max:189|required',
           'provisional_planning'=>'max:500|required'
        ]);

        $specification=Specification::find($id);
        $specification->title=$request->input('title');
        $specification->project_type=$request->input('project_type');
        $specification->existing_desc=$request->input('existing_desc');
        $specification->requirement_spec=$request->input('requirement_spec');
        $specification->hardware_env=$request->input('hardware_env');
        $specification->software_env=$request->input('software_env');
        $specification->provisional_planning=$request->input('provisional_planning');
        $specification->updated_by=auth()->user()->id;
        
        if($specification->save()){
            if(Session::has('t'))
                $t=Session::get('t');
            else
                $t='false';
           return redirect('/internships/'.$specification->internship->id.'/edit?t='.$t);
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
        //
    }
}

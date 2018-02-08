<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Manager;
use App\Company;
use Illuminate\Support\Facades\Session;
use App\Registration;
use App\Http\Controllers\InternShipsController;


class CompaniesManagersController extends Controller
{
   
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('IntershipsAccessRights');
        $this->middleware('VerifyPreviousLocation')->only('edit');
    }

    public function generateDesiredArray(array $baseArray){
        $resultArray=[];
        foreach($baseArray as $key=>$value)
            $resultArray[$value['id']]=$value['name'];
    
        return $resultArray;
    }
    

       public function validateRequestInputs(Request &$request){
         $this->validate($request,[
           'name'=>'required|max:190',
           'phone'=>'required|numeric',
           'email'=>'unique:managers|email',
           'position'=>'required|max:190',
           'company'=>'required',
        ]);
       }

        public function setCompanyManagerFieldsFromRequest(Request &$request,Manager &$manager,bool $isUpdate){
            $manager->name=$request->input('name');
            $manager->phone=$request->input('phone');
            $manager->email=$request->input('email'); 
            $manager->position=$request->input('position');
            if($isUpdate){
              $manager->updated_by=auth()->user()->id;
           }else {
              $manager->created_by=auth()->user()->id;
              $manager->company=$request->input('company');
           }
        }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $companiesmanagers=Manager::paginate(10);
       return view('companiesmanagers.index')->with('companiesmanagers',$companiesmanagers);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::select('name','id')->get();
        $resultArray=$this->generateDesiredArray((array)$companies->toArray());
        return view('companiesmanagers.create')->with('companies', $resultArray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequestInputs($request);
        $manager=new Manager();
        $this->setCompanyManagerFieldsFromRequest($request,$manager,false);
        if($manager->save()){
            $id=$manager->id;

            Session::put('cm',$id);
              return redirect('/internships/create');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companyManager=Manager::find($id);
        return view('companiesmanagers.show')->with('companyManager',$companyManager);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companyManager=Manager::find($id);
        return view('companiesmanagers.edit')->with('companyManager',$companyManager);       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       $this->validate($request,[
           'name'=>'required|max:190',
           'phone'=>'required|numeric',
           'email'=>'email',
           'position'=>'required|max:190',
        ]);
         $manager=null;
        if($request->ajax())
            $manager=Manager::find($request->get('id'));
        else
            $manager=Manager::find($id);
        
        $this->setCompanyManagerFieldsFromRequest($request,$manager,true);
        $manager->save();
      
            if($request->ajax())
              return Response::json(["company"=>$manager->company],"200");
               if(Session::has('t'))
                 $t=Session::get('t');
               else
                 $t='false';

        return redirect('/company/'.$manager->company.'/edit?t='.$t);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}

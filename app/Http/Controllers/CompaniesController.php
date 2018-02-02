<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request as Req;
use App\Company;
use Illuminate\Support\Facades\Session;
class CompaniesController extends Controller
{

    public function __construct(){
       $this->middleware('auth');
       $this->middleware('IntershipsAccessRights');
       $this->middleware('VerifyPreviousLocation')->only('edit');
    }

   public function validateRequestInputs(Request &$request){
         $this->validate($request,[
           'name'=>'required|max:190',
           'activity'=>'required|max:190',
           'phone'=>'required|unique:companies|numeric',
           'fax'=>'nullable|unique:companies|numeric',
           'address'=>'required|max:190',
        ]);
   }

   public function setCompanyFieldsFromRequest(Request &$request,Company &$company,bool $isUpdate){
         $company->name=$request->input('name');
         $company->activity=$request->input('activity');
         $company->phone=$request->input('phone');
         $company->address=$request->input('address'); 
         if($isUpdate)
           $company->updated_by=auth()->user()->id;
         else 
           $company->created_by=auth()->user()->id;
           
         if($request->input('fax'))
            $company->fax=$request->input('fax');
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return dd(Req::get('id'));
        $companies=Company::paginate(10);
        return view('companies.index')->with('companies',$companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
          return view('companies.create');
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
        $company=new Company();
        $this->setCompanyFieldsFromRequest($request,$company,false);
        if($company->save()){
         $id=$company->id;
         if($request->ajax())
            return Response::json(['company'=>$id],'200');
        Session::put('ci',$id);
        return redirect('/companiesmanagers/create');
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
        $company=Company::find($id);
        return view('companies.show')->with('company',$company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=Company::find($id);
        return view('companies.edit')->with('company',$company);
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
           'name'=>'required|max:190',
           'activity'=>'required|max:190',
           'phone'=>'required|numeric',
           'fax'=>'nullable|numeric',
           'address'=>'required|max:190',
        ]);

        $company=null;
        if($request->ajax())
          $company=Company::find($request->get('id'));
        else if(isset($id) && ctype_digit($id))
          $company=Company::find($id);
        else
          $company=Company::find((int)$request->input('id'));

        $this->setCompanyFieldsFromRequest($request,$company,true);
        $company->save();
        if($request->ajax())
              return Response::json([],"200");

        return redirect(auth()->user()->Dashboard)->with('success','demande du stage modifiè avec success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company=Company::find($id);
        try{
           $company->delete();
           return redirect('/company')->with('success','company deleted');

        }catch(QueryException $e){
           return back();
        }
    }
}
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\FramingRequest;
use App\Internship;
use App\Company;
use App\Manager;
use App\Registration;
use App\User;
use App\Specification;
use DB;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CompaniesManagersController;

class InternShipsController extends Controller
{
   public function __construct(){
      $this->middleware('auth');
      $this->middleware('IntershipsAccessRights');
      $this->middleware('VerifyPreviousLocation')->only('edit','dynamicViewInternshipDemand');
      $this->middleware('AdminAccessRights')->except('edit','update','dynamicViewInternshipDemand','storeInternshipDemand');
   }

   public function getFormattedSession(){
         $month=date('m');
         if((int)$month>=9)
            return date('Y').'/'.((int)date('Y')+1);
        return ((int)date('Y')-1).'/'.date('Y');
   }

    public function generateDesiredArray(array $baseArray){
        $resultArray=[];
        foreach($baseArray as $key=>$value)
            $resultArray[$value['id']]=$value['firstname']." ".$value['lastname'];
    
        return $resultArray;
    }

     public function studentLevel($ch){
        for($i=0;$i<strlen($ch);$i++){
            if(ctype_digit(substr($ch,$i,1)))
              return substr($ch,$i,1);
        }
        return -1;
     }

     public function dynamicViewInternshipDemand(){
           $teachers=User::where('role',1)->get()->toArray();
           $arrayTeachers=$this->generateDesiredArray($teachers);
           Session::put('teachers',$arrayTeachers);
           return view('internships.allinternshipsforms');
     }

     public function storeInternshipDemand(Request $request){
         $this->validate($request,[
           'framer'=>'nullable',
           'companyname'=>'max:189|required',
           'companyactivity'=>'max:189|required',
           'companyaddress'=>'max:189|required',
           'managername'=>'max:189|nullable',
           'manageremail'=>'max:189|required',
           'managerposition'=>'max:189|required',
           'spectitle'=>'max:189|nullable',
           'projecttype'=>'max:189|nullable',
           'existingdesc'=>'max:189|nullable',
           'requirementspec'=>'max:189|required',
           'hardwareenv'=>'max:189|nullable',
           'softwareenv'=>'max:189|nullable',
           'provisionalplanning'=>'max:500|nullable'
         ]);

         if($request->ajax()){
            $registrationlist=Registration::where('student',auth()->user()->id)->get()->toArray();
            if(count($registrationlist) ==0)
              $lastregistration=null;
            else
              $lastregistration=$registrationlist[count($registrationlist)-1];
               
            if($request->input('type')=='pfe' && $this->studentLevel($lastregistration['group'])==3)
              return Response::json(['error'=>'il faut faire une nouvelle inscription']);
            if($lastregistration!=null){
            $company=new Company();
            $company->name=$request->input('companyname');
            $company->activity=$request->input('companyactivity');
            $company->phone=$request->input('companyphone');
            $company->fax=$request->input('companyfax');
            $company->address=$request->input('companyaddress');
            $company->created_by=auth()->user()->id;
              if($company->save()){
                 $companyManager=new Manager();
                 $companyManager->name=$request->input('managername');
                 $companyManager->phone=$request->input('managerphone');
                 $companyManager->email=$request->input('manageremail');
                 $companyManager->company=$company->id;
                 $companyManager->position=$request->input('managerposition');
                 $companyManager->created_by=auth()->user()->id;
                     if($companyManager->save()){
                         $internship=new Internship();
                         $internship->student=$lastregistration['id'];
                         $internship->start_date=$request->input('start_date');
                         $internship->end_date=$request->input('end_date');
                         $internship->type=$request->input('type');
                         $internship->student1=$request->input('buddy');
                         $internship->company_framer=$companyManager->id;
                         $internship->created_by=auth()->user()->id;
                                if($request->input('type') =='pfe'){
                                   $requestFraming=null;
                                   $fra=$request->input('framer');
                                     if($fra!=null){
                                        $requestFraming=new FramingRequest();
                                        $requestFraming->teacher=$fra;
                                        $requestFraming->request_type="request";
                                        $requestFraming->created_by=auth()->user()->id;
                                      }
                                   $specification=new Specification();
                                   $specification->title=$request->input('spectitle');
                                   $specification->project_type=$request->input('projecttype');
                                   $specification->existing_desc=$request->input('existingdesc');
                                   $specification->requirement_spec=$request->input('requirementspec');
                                   $specification->hardware_env=$request->input('hardwareenv');
                                   $specification->software_env=$request->input('softwareenv');
                                   $specification->provisional_planning=$request->input('provisionalplanning');
                                   $specification->created_by=auth()->user()->id;
                                   if($specification->save()){
                                       $internship->specifications=$specification->id;
                                       if($internship->save()){
                                          if($requestFraming != null)
                                              $requestFraming->internship=$internship->id;
                                          if($requestFraming->save())
                                             return Response::json(['success'=>'demande de stage enregisté'],'200');
                                          else
                                             return Response::json(['error'=>"une erreur est produite veuillez recommencer l procedure"],'200');
                                        }
                                   }
                                }else{
                                    if($internship->save())
                                       return Response::json(['success'=>'demande de stage enregisté'],'200');
                                }
                    }
                }
                  }else{
                          return Response::json(['error'=>"vous n avez pas une regitartion"],'400');
                  }
            }
    }

   public function create(){
       $teachers=User::where('role',1)->get()->toArray();
       $arrayTeachers=$this->generateDesiredArray($teachers);
       return view('internships.create')->with('teachers',$arrayTeachers);
   }


    public function store(Request $request,$companyFramer=null){
        $this->validate($request,[
          'start_date'=>'required|date',
          'end_date'=>'required|date',
          'type'=>'required',
          'framer'=>'required|numeric',
          'cm'=>'required|numeric'
        ]);

        $year=date('Y');
        $session=$this->getFormattedSession();
        $internship=new Internship();
        $registration=Registration::where('student',auth()->user()->id)->where(function ($query) use($session){
            return $query->where('session',$session);
        })->first();

        $internship->student=$registration->id;
        $internship->start_date=$request->input('start_date');
        $internship->end_date=$request->input('end_date');
        $internship->framer=$request->input('framer');
        $internship->company_framer=$request->input('cm');
        $internship->type=$request->input('type');
        $internship->created_by=auth()->user()->id;
        if($internship->save()){
        if($request->ajax())
             return response(['demande enregistré','200']);

          return redirect(auth()->user()->Dashboard)->with('success','demande enregistré');
        }
        return  back();
    }


    public function edit(Request $request,$id){
        $internship=Internship::find($id); 
        $managerTeachers=User::where('role',1)->get(['id','firstname','lastname'])->toArray();
        $managerTeachers=$this->generateDesiredArray($managerTeachers);
        $framerRecord=$internship->framer;
        Session::put('framerRecord',$framerRecord);
        return view('internships.edit')->with('internship',$internship)->with('managerTeachers',$managerTeachers);
    }


    public function update(Request $request,$id){
            $this->validate($request,[
                'start_date'=>'required|date',
                'end_date'=>'required|date',
                'framer'=>'required'
             ]);
            
                $internship=Internship::find($id);
                $internship->updated_by=auth()->user()->id;
                $internship->start_date=$request->input('start_date');
                $internship->end_date=$request->input('end_date'); 
                $internship->framer=$request->input('framer');   
                $companyManager=$internship->company_framer;       
                $internship->save();
                if(Session::has('t'))
                  $t=Session::get('t');
                else
                 $t='false';
        return redirect('/companiesmanagers/'.$companyManager.'/edit?t='.$t);
    }

    public function index(Request $request){
       $internships=Internship::whereYear('created_at','>=',date('Y'))->paginate(10);
       return view('internships.index')->with('internships',$internships);
    }

    public function show($id,Request $request){
          $internship=Internship::find($id);
          return view('internships.show')->with('internship',$internship);
    }
}

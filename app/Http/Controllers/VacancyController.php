<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Employers;
use App\Models\User;
use App\Models\Skills;
use App\Models\Specialties;
use App\Models\Resumes;
use App\Models\Vacancies;

use PDF;


class VacancyController extends Controller{
   
    public function index(){
       
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='employer'){
            $user = User::findOrFail($user_current->id);
            
            $employer = Employers::where('user_id',$user->id)->get();
        
            $vacancies = Vacancies::where('employer_id',$employer[0]->id)->get();
            $count=0;
            $ress=array();
            $resumeS = Resumes::get();
            foreach($vacancies as $vac){
                foreach($vac->specialties as $sp){
                    for($i=0; $i<count($resumeS); $i++){
                    foreach($resumeS[$i]->specialties as $spec){
                        if($sp->id==$spec->id){
                            $count++;
                        }
                    }
                    if($count>0){
                        $c=0;
                        for($j=0; $j<count($ress); $j++){
                            if($ress[$j]->id==$resumeS[$i]->id){
                                $c++;
                            }
                        }
                        if($c==0){
                            array_push($ress, $resumeS[$i]);
                        }
                        $c=0;
                    }
                    $count=0;
                    }
                }
            }
            $resumesTop = Resumes::orderBy('view_count','DESC')->skip(0)->take(2)->get();
            $specialties = DB::table('specialties')->get();
            return view('vacancies.index',compact('vacancies'),['employer'=>$employer,'specialties'=>$specialties,'resumes'=>$ress,'resumesTop'=>$resumesTop]);  
        }
        else{
            return view('403');
        }
    }

   public function create(){
        
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='employer'){
            $user = User::findOrFail($user_current->id);
        
            $employer = Employers::where('user_id',$user->id)->get();
            $specialties = DB::table('specialties')->orderBy('name','asc')->get();
            return view('vacancies.create',['emp'=>$employer,'specs'=>$specialties,'user'=>$user]);
        }
        else{
            return view('403');

        } 
   }

   public function store(){

        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='employer'){
            $user = User::findOrFail($user_current->id);
            $employer = Employers::where('user_id',$user->id)->get();

            $vacancy=new Vacancies();
            $vacancy->name=request('name');
            $vacancy->surname=request('surname');
            $vacancy->email=request('email');
            $vacancy->phone_number=request('phone_number');
            $vacancy->description=request('description');
            $vacancy->salary=request('salary');
            $vacancy->view_count=0;
            $vacancy->employer_id=$employer[0]->id;
            $ldate = date('Y-m-d H:i:s');
            $vacancy->created_at=$ldate;
            $vacancy->updated_at=$ldate;
            $skills1 = request('skills');
            $specialties=request('specialties');
            $vacancy->save();

            if($specialties!=null){
                $specialties_in_db=new Specialties();               
                foreach($specialties as $spec){
                    $specialties_in_db=Specialties::where('name',$spec)->get();
                  $vacancy->specialties()->attach($specialties_in_db);
                }  
            }
            if($skills1!=null){    
                $skills_in_db=array();
                foreach ($skills1 as $skill) {
                    $skill2=Skills::Where('name', 'like', '%' .strtolower($skill). '%')->get();

                    if(empty($skill2) || $skill2=="" ||$skill2==null || count($skill2)==0){
                        $n_skill=new Skills();
                        $n_skill->name=$skill;
                        $n_skill->save();
                        $vacancy->skills()->attach($n_skill);
                    }
                    else {
                       foreach($skill2 as $sk){
                            array_push($skills_in_db,$sk->id); 
                       }
                    }
                }
                if(count($skills_in_db)!=0){
                    $skills_in_db=array_unique($skills_in_db);
                    foreach($skills_in_db as $sk){
                        $found_skill=new Skills();
                        $found_skill=Skills::findOrFail($sk);
                        $vacancy->skills()->attach($found_skill);
                    }
                }
            }
            error_log($vacancy);

            return redirect('/home_e');   
        }
        else{
            return view('403');
        }
    }

    public function show($id){

        $user_current=auth()->user();
        error_log("user_current ==".$user_current);
        if(!empty($user_current) && $user_current->role==='employer'){
            $user = User::findOrFail($user_current->id);
            $employer1 = Employers::where('user_id',$user->id)->get();
            $vacancy =Vacancies::findOrFail($id);
            $employer=$employer1[0];

            $arrayIds=array();
        
            $specialties = DB::table('specialties')->get();

            $resumesTop = Resumes::orderBy('view_count','DESC')->skip(0)->take(2)->get();
            //$users = $users->except([1, 2, 3]);

            return view('vacancies.show',compact('vacancy'),['specialties'=>$specialties,'emp'=>$employer,'resumesTop'=>$resumesTop]);  
        }
        else{
            return view('403');
        }
    }

    public function destroy($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='employer'){
            $vacancy = Vacancies::findOrFail($id);

            foreach($vacancy->skills as $sk){
                $vacancy->skills()->detach($sk);
            }
            foreach($vacancy->specialties as $sp){
                $vacancy->specialties()->detach($sp);
            }
            $vacancy->delete();
            return redirect('/home_e'); 
        }
        else{
            return view('403');
        }  
    }

    public function update(){

        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='employer'){
            $user = User::findOrFail($user_current->id);
            
            $employer = Employers::where('user_id',$user->id)->get();
            $vacancy = Vacancies::find(request('id'));
    
            $vacancy->name=request('name');
            $vacancy->surname=request('surname');
            $vacancy->email=request('email');
            $vacancy->phone_number=request('phone_number');
            $vacancy->description=request('description');
            $vacancy->salary=request('salary');
            $vacancy->employer_id=$employer[0]->id;
            $ldate = date('Y-m-d H:i:s');
            $vacancy->updated_at=$ldate;

            $specsNew=request('specialties');
            $skillsNew=request('skills') ;

            $assignedSkills=request('assignedSkills');
            $assignedSpecs=request('assignedSpecs');

            if($assignedSpecs!=null){
                $specialties_assigned=new Specialties();    
  
                foreach($vacancy->specialties as $sp){
                    if(!in_array($sp->name,$assignedSpecs)){
                            $vacancy->specialties()->detach($sp);
                    }
                }
            }

            $specialties = DB::table('specialties')->get();
            $skills = DB::table('skills')->get();

            if($specialties!=null && $specsNew!=null){
                $specialties_to_assign=new Specialties();      
                foreach($specsNew as $spec){

                    $specialties_to_assign=Specialties::where('name',$spec)->get();

                    if($assignedSpecs!=null){
                        if(!in_array($spec, $assignedSpecs)){
                            $vacancy->specialties()->attach($specialties_to_assign);
                        }  
                    }
                    else{
                        $vacancy->specialties()->attach($specialties_to_assign);
                    }
                }  
            }

            if($assignedSkills!=null){
                $skills_assigned=new Specialties();    
                $count=0;
                foreach($vacancy->skills as $sk){
                    if(!in_array($sk->name,$assignedSkills)){
                            $vacancy->skills()->detach($sk);
                    }
                }
            }

            if($skillsNew!=null && $skills!=null){    
                $skills_in_db=array();
                foreach ($skillsNew as $skill) {
                    $skill2=Skills::Where('name', 'like', '%' .strtolower($skill). '%')->get();

                    if(empty($skill2) || $skill2=="" ||$skill2==null || count($skill2)==0){
                        $n_skill=new Skills();
                        $n_skill->name=$skill;
                        $n_skill->save();
                        $vacancy->skills()->attach($n_skill);
                    }
                    else {
                       foreach($skill2 as $sk){
                            array_push($skills_in_db,$sk->id); 
                       }
                    }
                }
                if(count($skills_in_db)!=0){
                    $skills_in_db=array_unique($skills_in_db);
                    
                    foreach($skills_in_db as $sk){
                        $found_skill=new Skills();
                        $found_skill=Skills::findOrFail($sk);
                        $vacancy->skills()->attach($found_skill);
                    }
                }
            }

            $vacancy->save();
            return redirect('/home_e');
        }  
        else{
            return view('403');
        } 
    }

}

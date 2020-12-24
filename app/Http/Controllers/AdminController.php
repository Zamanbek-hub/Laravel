<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Resumes;
use App\Models\Skills;
use App\Models\Students;
use App\Models\Specialties;
use App\Models\Resume_skills;
use App\Models\Regions;
use App\Models\User;
use App\Models\Vacancies;
use App\Models\Employers;

use App\Models\Selected_Resumes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller{

    public function index(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){
             return view('admin.index');
        }
        else{
            return view('403');
        }
    }

    public function index_students(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){
            $students=Students::get();

            $availableUsers=User::where('role','student')->get();
            
            foreach($availableUsers as $emp){
                error_log($emp->email);
            }

            $foundUsers=array();

            $studIds=array();

            foreach($students as $emp){
                array_push($studIds,$emp->user_id);
            }

            if(count($availableUsers)!=0){
                foreach($availableUsers as $us){
                   if(!in_array($us->id,$studIds)){
                       array_push($foundUsers,$us);
                   }
                }
            }
            return view('admin.index_students',['students'=>$students,'foundUsers'=>$foundUsers,'users'=>$availableUsers]);
        }
        else{
            return view('403');
        }
    }

    public function index_skills(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){
            $skills=Skills::get();
            return view('admin.index_skills',['skills'=>$skills]);
        }
        else{
            return view('403');
        }
    }

    public function index_specialties(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){
            $specs=Specialties::get();
            return view('admin.index_specialties',['specialties'=>$specs]);
        }
        else{
            return view('403');
        }
    }

    public function index_users(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){
            $users=User::get();
            return view('admin.index_users',['users'=>$users]);
        }
        else{
            return view('403');
        }
    }

    public function index_employers(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){
            $employers=Employers::get();

            $availableUsers=User::where('role','employer')->get();

            $foundUsers=array();

            $empIds=array();

            foreach($employers as $emp){
                array_push($empIds,$emp->user_id);
            }

            if(count($availableUsers)!=0){
                foreach($availableUsers as $us){
                   if(!in_array($us->id,$empIds)){
                       array_push($foundUsers,$us);
                   }
                }
            }
            $regions=Regions::get();
            return view('admin.index_employers',['employers'=>$employers,'foundUsers'=>$foundUsers,'regions'=>$regions,"users"=>$availableUsers]);
        }
        else{
            return view('403');
        }
    }

    public function index_vacancies(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){
            $vacancies=Vacancies::get();
            return view('admin.index_vacancies',compact('vacancies'));
        }
        else{
            return view('403');
        }
    }

    public function index_resumes(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){
            $resumes=Resumes::get();
            return view('admin.index_resumes',compact('resumes'));
        }
        else{
            return view('403');
        }
    }

    public function index_regions(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $regions=Regions::get();
            $users=User::where('role','employer')->get();

            return view('admin.index_regions',['regions'=>$regions,'users'=>$users,'s'=>0]);
        }
        else{
            return view('403');
        }
    }

    public function store_skill(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $new_skill=new Skills();
            $new_skill->name=request('skill'); 

            $skills=Skills::get();

            if($skills!=null){
                $count=0;
                foreach($skills as $in_db){
                    if(strtolower(request('skill'))==strtolower($in_db->name)){
                        $count++;
                    }
                }
                if($count==0){
                    $new_skill->save();
                    return redirect('/home_a/skills?successfully_added');      
                }
                return redirect('/home_a/skills?skill_name_already_exists_error');       
            } 
         }
        else{
            return view('403');
        }
    }

    public function store_specialty(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $new_spec=new Specialties();
            $new_spec->name=request('spec'); 

            $specs=Specialties::get();
            if($specs!=null){
                $count=0;
                foreach($specs as $in_db){
                    if(strtolower(request('spec'))==strtolower($in_db->name)){
                        $count++;
                    }
                }
                if($count==0){
                    $new_spec->save();
                    return redirect('/home_a/specialties?added_successfully');          
                }
            }
            return redirect('/home_a/specialties?specialty_name_already_exists_error');          
        }
        else{
            return view('403');
        }
    }

    public function store_user(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $new_user=new User();
            $new_user->email=request('email');            
            $new_user->role=request('role'); 
            $new_user->name="Someone";
            $ldate = date('Y-m-d H:i:s');
            $new_user->created_at=$ldate;
            $new_user->updated_at=$ldate;
            error_log(request('email'));
            $in_db=User::where('email',request('email'))->get();

            if($in_db===null || empty($in_db) || count($in_db)==0 ){
                $hashedPassword = Hash::make(request('password'));
                $new_user->password=$hashedPassword; 
                $new_user->save();   
                return redirect('/home_a/users?added_successfully');          
            }
            return redirect('/home_a/users?email_already_exists_in_database');  
                    
        }
        else{
            return view('403');
        }
    }

    public function store_employer(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $new_employer=new Employers();
            $new_employer->name=request('name');
            $new_employer->surname=request('surname');
            $new_employer->phone_number=request('phone_number');
            $new_employer->company_name=request('company_name');

            $user = User::findOrFail(request('user'));
            $region = Regions::findOrFail(request('region'));
            
            $user->name=request('name');
            $user->save();
            $new_employer->user_id=$user->id;
            $new_employer->region_id=$region->id;
            $new_employer->save();
            return redirect('/home_a/employers');          
        }
        else{
            return view('403');
        }
    }

    public function store_student(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $new_student=new Students();
            $new_student->name=request('name');
            $new_student->surname=request('surname');
            $new_student->phone_number=request('phone_number');
            $new_student->grade=request('grade');

            $user = User::findOrFail(request('user'));
            
            $user->name=request('name');
            $user->save();
            $new_student->user_id=$user->id;
            $new_student->save();
            return redirect('/home_a/students');          
        }
        else{
            return view('403');
        }
    }

    public function store_region(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $new_region=new Regions();
            $new_region->name=request('region'); 

            $regions=Regions::get();
            if($regions!=null){
                $count=0;
                foreach($regions as $in_db){
                    if(strtolower(request('region'))==strtolower($in_db->name)){
                        $count++;
                    }
                }
                if($count==0){
                    $new_region->save();
                    return redirect('/home_a/regions?added_successfully');          
                }
            }
            return redirect('/home_a/regions?region_name_already_exists_error');          
        }
        else{
            return view('403');
        }
    }


    public function update_skill(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $skills=Skills::get();
            $exist_sskill=Skills::findOrFail(request('skill_id'));

            if($skills!=null){
                $count=0;
                foreach($skills as $in_db){
                    if(strtolower(request('name'))==strtolower($in_db->name) && $exist_sskill->id!=$in_db->id ){
                        $count++;
                    }
                }
                if($count==0){
                    $exist_sskill->name=request('name');
                    $exist_sskill->save();
                    return redirect('/home_a/skills?successfully_updated');      
                }
                return redirect('/home_a/skills?skill_name_already_exists_error');  
            }     
         }
        else{
            return view('403');
        }
    }

    public function destroy_skill($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){
            $user = User::findOrFail($user_current->id);
            
            $exist_skill=Skills::findOrFail(request('skill_id'));
            
            foreach($exist_skill->resumes as $res){
                $exist_skill->resumes()->detach($res);
            }

            foreach($exist_skill->vacancies as $vac){
                $exist_skill->vacancies()->detach($vac);
            }
            $exist_skill->delete();
            return redirect('/home_a/skills?deleted_successfully');
        }
        else{
            return view('403');   
        }   
   }

    public function update_specialty(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $specs=Specialties::get();
            $exist_specialty=Specialties::findOrFail(request('spec_id'));

            if($specs!=null){
                $count=0;
                foreach($specs as $in_db){
                    if(strtolower(request('name'))==strtolower($in_db->name) &&  $exist_specialty->id!=$in_db->id ){
                        $count++;
                    }
                }
                if($count==0){
                    $exist_specialty->name=request('name');
                    $exist_specialty->save();
                    return redirect('/home_a/specialties?successfully_updated');      
                }
                return redirect('/home_a/specialties?specialty_name_already_exists_error');  
            }     
        }
        else{
            return view('403');
        }
    }

    public function destroy_specialty($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){
            
            $exist_specialty=Specialties::findOrFail(request('spec_id'));
            
            foreach($exist_specialty->resumes as $res){
                $exist_specialty->resumes()->detach($res);
            }

            foreach($exist_specialty->vacancies as $vac){
                $exist_specialty->vacancies()->detach($vac);
            }
            $exist_specialty->delete();
            return redirect('/home_a/specialties?deleted_successfully');
        }
        else{
            return view('403');   
        }   
    }

    public function update_student(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $exist_student=Students::findOrFail(request('student_id'));

            $exist_student->name=request('name');
            $exist_student->surname=request('surname');
            $exist_student->phone_number=request('phone_number');
            $exist_student->grade=request('grade');
            $exist_student->updated_at= date('Y-m-d H:i:s');

            $user = User::findOrFail($exist_student->user_id);
            
            $user->name=request('name');
            $user->save();
            $exist_student->save();
            return redirect('/home_a/students?successfully_edited');          
        }
        else{
            return view('403');
        }
    }

    public function destroy_student($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){
            
            $exist_student=Students::findOrFail(request('student_id'));
            $user = User::findOrFail($exist_student->user_id);
            error_log($user->email);
   
            $resume=Resumes::Where('student_id',request('student_id') )->get();

            if($resume!=null){
                foreach($resume as $res){
                    foreach($res->skills as $sk){
                        $res->skills()->detach($sk);
                    }
                    foreach($res->specialties as $vac){
                        $res->specialties()->detach($vac);
                    }
                    $res->delete();
                }
            }
            $exist_student->delete();
            $user->delete();

            return redirect('/home_a/students?deleted_successfully');
        }
        else{
            return view('403');   
        }   
    }

    public function update_employer(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $new_employer=Employers::findOrFail(request('employer_id'));
            
            $new_employer->name=request('name');
            $new_employer->surname=request('surname');
            $new_employer->phone_number=request('phone_number');
            $new_employer->company_name=request('company_name');
            $new_employer->region_id=request('region');

            $user = User::findOrFail($new_employer->user_id);
            
            $user->name=request('name');
            $user->save();
            $new_employer->save();
            return redirect('/home_a/employers?edited_successfully');          
        }
        else{
            return view('403');
        }
    }

    public function destroy_employer($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){
            $exist_employer=Employers::findOrFail(request('employer_id'));
            $user = User::findOrFail($exist_employer->user_id);
            error_log($user->email);
   
            $vacancies=Vacancies::Where('employer_id',request('employer_id') )->get();

            if($vacancies!=null){
                foreach($vacancies as $vac){
                    foreach($vac->skills as $sk){
                        $vac->skills()->detach($sk);
                    }
                    foreach($vac->specialties as $spec){
                        $vac->specialties()->detach($spec);
                    }
                    $vac->delete();
                }
            }
            $exist_employer->delete();
            $user->delete();

            return redirect('/home_a/employers?deleted_successfully');
        }
        else{
            return view('403');   
        }   
   }

   public function update_region(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $exist_region=Regions::findOrFail(request('region_id'));
            $regions=Regions::get();

            if($regions!=null){
                $count=0;
                foreach($regions as $in_db){
                    if(strtolower(request('name'))==strtolower($in_db->name) &&  $exist_region->id!=$in_db->id ){
                        $count++;
                    }
                }
                if($count==0){
                    $exist_region->name=request('name');
                    $exist_region->updated_at= date('Y-m-d H:i:s');
                    $exist_region->save();
                    return redirect('/home_a/regions?successfully_updated');      
                }
                return redirect('/home_a/regions?region_name_already_exists_error'); 
            }
        }
        else{
            return view('403');
        }
    }

    public function destroy_region($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){
            
            $exist_region=Regions::findOrFail(request('region_id'));
            $empoyers=Employers::Where('region_id',$exist_region->id)->get();

            if($empoyers!=null && count($empoyers)>0){
                return redirect('/home_a/regions?deleted_error');
            }
            $exist_region->delete();
            return redirect('/home_a/regions?deleted_successfully');
        }
        else{
            return view('403');   
        }   
    }

    public function show_vacancy($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){

            $vacancy = Vacancies::findOrFail($id);
            return view('admin.details.show_vacancies',['vacancy'=>$vacancy]);
        }
        else{
            return view('403');  
        }  
    }

    public function show_resume($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){

            $resume = Resumes::findOrFail($id);
            return view('admin.details.show_resumes',['resume'=>$resume]);
        }
        else{
            return view('403');  
        }  
    }

    public function destroy_vacancy(){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){
            
            $vacancy = Vacancies::findOrFail(request('vacancy_id'));

            foreach($vacancy->skills as $sk){
                $vacancy->skills()->detach($sk);
            }
            foreach($vacancy->specialties as $sp){
                $vacancy->specialties()->detach($sp);
            }

            $vacancy->delete();
            return redirect('/home_a/vacancies?deleted_successfully');
        }
        else{
            return view('403');   
        }
    }

    public function destroy_resume(){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){
            
            $resume = Resumes::findOrFail(request('resume_id'));

            foreach($resume->skills as $sk){
                $resume->skills()->detach($sk);
            }
            foreach($resume->specialties as $sp){
                $resume->specialties()->detach($sp);
            }

            $resume->delete();
            return redirect('/home_a/resumes?deleted_successfully');
        }
        else{
            return view('403');   
        }  
   }

   public function update_user(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $exist_user=User::findOrFail(request('user_id'));
            $in_db=User::where('email',request('email'))->Where('id', '!=' ,$exist_user->id )->get();

            if($in_db===null || empty($in_db) || count($in_db)==0 ){
                $exist_user->email=request('email');
                $exist_user->save(); 
                return redirect('/home_a/users?successfully_updated');      
            }
            return redirect('/home_a/users?email_already_exists_error');
        }
        else{
            return view('403');
        }
    }

    public function change_user_password(){
        $user_current=auth()->user();
        if(!empty($user_current) && $user_current->role=='admin'){

            $exist_user=User::findOrFail(request('user_id'));
            $hashedPassword = Hash::make(request('password'));
            $exist_user->password=$hashedPassword;
            $exist_user->save(); 
            return redirect('/home_a/users?successfully_changed');      
        }
        else{
            return view('403');
        }
    }

    public function destroy_user($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='admin'){
            
            $exist_user=User::findOrFail(request('user_id'));

            if($exist_user->role=='employer'){
                $exist_employer=Employers::where('user_id',$exist_user->id)->get();
       
                if($exist_employer!=null && count($exist_employer)>0){
                    $vacancies=Vacancies::Where('employer_id',$exist_employer[0]->id )->get();
        
                    if($vacancies!=null){
                        foreach($vacancies as $vac){
                            foreach($vac->skills as $sk){
                                $vac->skills()->detach($sk);
                            }
                            foreach($vac->specialties as $spec){
                                $vac->specialties()->detach($spec);
                            }
                            $vac->delete();
                        }
                    }
                    $exist_employer[0]->delete(); 
                }
                $exist_user->delete();
                return redirect('/home_a/users?user_employer_successfully_deleted');
            }
            else if($exist_user->role=='student'){

                $exist_student=Students::where('user_id',$exist_user->id)->get();

                if($exist_student!=null && count($exist_student)>0){
                    $resume=Resumes::Where('student_id',$exist_student[0]->id )->get();

                    if($resume!=null){
                        foreach($resume as $res){
                            foreach($res->skills as $sk){
                                $res->skills()->detach($sk);
                            }
                            foreach($res->specialties as $vac){
                                $res->specialties()->detach($vac);
                            }
                            $res->delete();
                        }
                    }
                    $exist_student[0]->delete();
                }  
                $exist_user->delete();
                return redirect('/home_a/users?user_student_successfully_deleted');    
            }
        }
        else{
            return view('403');   
        }   
    }

}
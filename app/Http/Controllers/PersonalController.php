<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    //
     //show personal info cv form
     public function showPersonalCVForm(User $user){
        $userData  =(bool)DB::table('personals')->where('user_id', auth()->id())->first(); 
        if($userData){
            $skillData =(bool)DB::table('skills')->where('user_id', auth()->id())->first(); 
            if($skillData){
                $data =(bool)DB::table('experiences')->where('user_id', auth()->id())->first();       
                if($data){
                    return view('resume.graduation-cv-form' , ['user'=>$user , 'graduations' => $user->graduation()->latest()->get()]);
                }else{
                    $id = $user->id;
                    return redirect("/create-cv-form/$id/work-experience");
                }
    
            }else{
                $id = $user->id;
                return redirect("/create-cv-form/$id/skills");
            }
        }else{
            return view('resume.personal-cv-form' , ['user'=>$user]);
        }

        
    }

    //set the personal cv data to database and going next step
    public function getPersonalCV(Request $request , User $user){
        $incomingFields = $request->validate([

            'name'=>'required',
            'familyName'=>'required',
            'age'=>'required',
            'gender'=>'required',
            'military'=>'required'
        ]);
            
            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['familyName'] = strip_tags($incomingFields['familyName']);
            $incomingFields['military'] = strip_tags($incomingFields['military']);
            $incomingFields['user_id'] = auth()->id();
            
            Personal::create($incomingFields);
            $id = $user->id;
  
        return redirect("/image-upload/$id" )->with('message','Your personal data have been saved!');
    }

     //change personal info form
     public function showChangePersonalInfo(User $user){
        $personal = $user->personal;
        return view ('changes.change-personal', ["user"=>$user , 'personal' => $personal]);
    }

    public function savePersonalChanging(Request $request, User $user){
        $incomingFields = $request->validate([
            'name'=>['required'],
            'familyName'=>['required'],
            'age'=>['required'],
            'gender'=>['required'],
            'military'=>['required']
         ]);

         Personal::where('id',$user->id)->update($incomingFields);
         $id = $user->id;
         return redirect("/change-profile/$id");        
    }

   
    

    

}

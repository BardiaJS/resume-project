<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Graduation;
use App\Models\Personal;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    //show correct page 
    public function showCorrectPage(){
        if(auth()->check()){
            return view("user-logged-in-page");
        }else{
            return view("homepage");
        }
            
    }

    //register the user 
    public function registerUser(Request $request){
        $incomingFields = $request->validate([
            'username'=>['required','min:3','max:12'],
            'email'=>['required','email',Rule::unique('users' , 'email')],
            'password'=>['required','confirmed','min:6']
         ]);
         $incomingFields['password'] = bcrypt($incomingFields['password']);

         $user = User::create($incomingFields);
         auth()->login($user);
         return redirect('/')->with('message','You created an account successfully!');
    }

    //logging in the user
    public function loginUserForm(){
        return view('login-page');
    }

    //signing out the user
    public function signoutUser(){
        auth()->logout();
        return redirect('/')->with('message','You are successfully logged out!');
    }

    //logging in the user
    public function loginUser(Request $request){
        $incomingFields = $request->validate([
            'email' => ['required','email'],
            'password'=> 'required'
        ]);
        
        if(auth()->attempt($incomingFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message' , 'You are logged in successfully');
        }else{
            return redirect('/')->with('failure' , 'Invalid data!');
        }
    }

    //show personal info cv form
    public function showPersonalCVForm(User $user){
        return view('personal-cv-form' , ['user'=>$user]);
        
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
        
        Personal::create($incomingFields);
        $id = $user->id;
        return redirect("/create-cv-form/$id/skills")->with('message','Your personal data have been saved!');
    }


    //show skills cv form
    public function showSkillsCVForm(User $user){
        return view('skills-cv-form', ['user'=>$user]);
    }



    //set the skill cv data to database and going next step
    public function getSkillCV(Request $request , User $user){
        $incomingFields = $request->validate([
            'title'=> 'string',
            'body'=> 'string',
        ]);
        Skill::create($incomingFields);
        $id = $user->id;
        return redirect("/create-cv-form/$id/skills")->with('message','Your skill data have been saved!');
    }



    // show the work experience form 
    public function showWorkExpCVForm(User $user){
        return view('work-experience-cv-form', ['user'=>$user]);
    }

    //set the work experience data to database
    public function getWorkExpCV(Request $request , User $user){
        $incomingFields = $request->validate([
            'body'=> 'string'
        ]);
        Experience::create($incomingFields);
        $id = $user->id;
        return redirect("/create-cv-form/$id/graduation")->with('message','Your work experience data have been saved!');
    }
    
    // show the graduation form 
    public function showGraduationCVForm(User $user){
        return view('graduation-cv-form', ['user'=>$user]);
    }

    // set the graduation form info to database
    public function getGraduationCV(Request $request , User $user){
        $incomingFields = $request->validate([
            'level'=>'required',
            'high_school_major'=> 'string',
            'university_major'=> 'string',
            'university_name'=> 'string',
        ]);
        Graduation::create($incomingFields);
        $id = $user->id;
        return redirect("/choose-template/$id/resume")->with('message','Your graduation data have been saved!');
    }

    // show the template for resume
    public function showTemplates(User $user){
        return view('template-page', ['user'=>$user]);
    }


    //show the first template
    public function showFirstTemplate(User $user , Personal $personal , Skill $skill , Experience $experience , Graduation $graduation){  

        return view('first-template', ['user'=>$user , 'personal' => $personal , 'skill' => $skill , 'experience' => $experience , 'graduation' => $graduation]);
    }


}

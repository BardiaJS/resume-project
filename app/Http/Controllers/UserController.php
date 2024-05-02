<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\Personal;
use App\Models\Experience;
use App\Models\Graduation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    //show correct page 
    public function showCorrectPage(){
        if(auth()->check()){
            return view("user.user-logged-in-page");
        }else{
            return view("home.homepage");
        }
            
    }

    //register the user 
    public function registerUser(Request $request){
        $incomingFields = $request->validate([
            'username'=>['required','min:3','max:12'],
            'email'=>['required','email',Rule::unique('users' , 'email')],
            'password'=>['required','confirmed','min:6'],
            'first_high_school_name'=>['required']

         ]);
         $incomingFields['password'] = bcrypt($incomingFields['password']);
         $user = User::create($incomingFields);
         auth()->login($user);
         return redirect('/')->with('message','You created an account successfully!');
    }

    //logging in the user
    public function loginUserForm(){
        return view('user.login-page');
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
        $data =(bool)DB::table('personals')->where('user_id', auth()->id())->first();       
        if($data){
            $id = $user->id;
            return redirect("/create-cv-form/$id/skills");
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
  
        return redirect("/create-cv-form/$id/skills" )->with('message','Your personal data have been saved!');
    }


    //show skills cv form
    public function showSkillsCVForm(User $user){
        return view('resume.skills-cv-form', ['user'=>$user , 'skills' => $user->skill()->latest()->get()]);
    }



    //set the skill cv data to database and going next step
    public function getSkillCV(Request $request , User $user){
        $incomingFields = $request->validate([
            'title'=> 'string',
            'body'=> 'string',
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Skill::create($incomingFields);
        $id = $user->id;
        return redirect("/create-cv-form/$id/skills")->with('message','Your skill data have been saved!');
    }



    // show the work experience form 
    public function showWorkExpCVForm(User $user){
        return view('resume.work-experience-cv-form', ['user'=>$user]);
    }

    //set the work experience data to database
    public function getWorkExpCV(Request $request , User $user){

        $id = $user->id;
        if(empty(($request['body']))){
            return redirect("/create-cv-form/$id/work-experience")->with('failure','Your work experience is empty!');
        }else{
            $incomingFields = $request->validate([
                'body'=>'string'
            ]);
            $incomingFields['body'] = strip_tags($incomingFields['body']);
            $incomingFields['user_id'] = auth()->id();
            
            Experience::create($incomingFields);
        }

        return redirect("/create-cv-form/$id/graduation")->with('message','Your work experience data have been saved!');
    }
    
    // show the graduation form 
    public function showGraduationCVForm(User $user){
        return view('resume.graduation-cv-form', ['user'=>$user , 'graduations' => $user->graduation()->latest()->get()]);
    }

    // set the graduation form info to database
    public function getGraduationCV(Request $request , User $user){

        //check wich part of graduation is empty
        if ((empty($request['university_name'])) && (empty($request['university_major'])) && (empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required',
            ]);
         
            $incomingFields['high_school_major'] =  "None";
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        }

        //
        if ((empty($request['university_name'])) && (empty($request['university_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=>'string'
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
        $id = $user->id;
        return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        }

//
        if ((empty($request['university_name'])) && (empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'university_major'=>'string'
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);

            $incomingFields['high_school_major'] =  "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
        $id = $user->id;
        return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        }



        if(empty($request['high_school_major'])){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'university_major'=> 'string',
                'university_name'=> 'string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] = "None";
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        }if ($request['university_major']){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=> 'string',

                'university_name'=> 'string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        }if(empty($request['university_name'])){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=> 'string',
                'university_major'=> 'string',

            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        }
        

        $incomingFields = $request->validate([
            'level'=>'required|string',
            'high_school_major'=> 'string',
            'university_major'=> 'string',
            'university_name'=> 'string',
        ]);
        $incomingFields['level'] = strip_tags($incomingFields['level']);
        $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
        $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
        $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
        $incomingFields['user_id'] = auth()->id();
        Graduation::create($incomingFields);
        $id = $user->id;
        return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        
    }

    // show the template for resume
    public function showTemplates(User $user){
        return view('templates.template-page', ['user'=>$user]);
    }


    //show the first template
    public function showFirstTemplate(User $user){
        $id = auth()->id();
        $personal = $user->personal;
        $skill = $user->skill()->latest()->get();
        $experience = $user->experience()->latest()->get();
        $graduation =  $user->graduation()->latest()->get();
        $user->isCreateCV = 1;
        $user->wichTeplate = 1;
        $user->save();

        return view('templates.first-template', ['user'=>$user , 'personal' => $personal , 'skills' => $skill , 'experiences' => $experience , 'graduations' => $graduation]);

    }

       //show the second template
       public function showSecondTemplate(User $user){
        $id = auth()->id();
        $personal = $user->personal;
        $skill = $user->skill()->latest()->get();
        $experience = $user->experience()->latest()->get();
        $graduation =  $user->graduation()->latest()->get();
        $user->isCreateCV = 1;
        $user->wichTeplate = 2;
        $user->save();

        return view('templates.second-template', ['user'=>$user , 'personal' => $personal , 'skills' => $skill , 'experiences' => $experience , 'graduations' => $graduation]);

    }

       //show the third template
       public function showThirdTemplate(User $user){
        $id = auth()->id();
        $personal = $user->personal;
        $skill = $user->skill()->latest()->get();
        $experience = $user->experience()->latest()->get();
        $graduation =  $user->graduation()->latest()->get();
        $user->isCreateCV = 1;
        $user->wichTeplate = 3;
        $user->save();

        return view('templates.third-template', ['user'=>$user , 'personal' => $personal , 'skills' => $skill , 'experiences' => $experience , 'graduations' => $graduation]);

    }

       //show the fourth template
       public function showFourthTemplate(User $user){
        $id = auth()->id();
        $personal = $user->personal;
        $skill = $user->skill()->latest()->get();
        $experience = $user->experience()->latest()->get();
        $graduation =  $user->graduation()->latest()->get();
        $user->isCreateCV = 1;
        $user->wichTeplate = 4;
        $user->save();

        return view('templates.fourth-template', ['user'=>$user , 'personal' => $personal , 'skills' => $skill , 'experiences' => $experience , 'graduations' => $graduation]);

    }

    //show user resume after making it
    public function showResume(User $user){
        $id = $user->id;
        if($user->wichTeplate == 1){
            return redirect("/first-template/$id");
        }else if($user->wichTeplate == 2){
            return redirect("/second-template/$id");

        }else if($user->wichTeplate == 3){
            return redirect("/third-template/$id");

        }else{
            return redirect("/fourth-template/$id");

        }


    }

    //show change setting list
    public function showProfilePage(User $user){
        return view('user.profile-page', ["user"=>$user]);
    }

    //change user info form
    public function showChangeUserInfo(User $user){
        return view('changes.change-user', ["user"=>$user]);
    }

    //save user info changing
    public function saveUserChanging(Request $request , User $user){
        $incomingFields = $request->validate([
            'username'=>'required',
            'email'=>['required','email',Rule::unique('users' , 'email')]
        ]);
        $user->update($incomingFields);
        $user->save();
        $id = $user->id;
        return redirect("/change-profile/$id");         
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

    //show skill changing form
    public function showChangeSkillInfo(User $user){
        $skill = $user->skill()->latest()->get();
        return view ('changes.change-skill', ["user"=>$user , 'skills' => $skill]);
    }

    //save skill information changing
    public function saveSkillChanging(Request $request, User $user){
        $incomingFields = $request->validate([
            'title'=> 'string',
            'body'=> 'string',
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        $skill = Skill::create($incomingFields);
        $skill->user_id = $user->id;
        $skill->save();
        $id = $user->id;
        return redirect("/create-cv-form/$id/edit/skill")->with('message' , 'successfully edited!');        
    }
    //show the graduation changing page
    public function showChangeGraduationInfo(User $user){
        $graduation =  $user->graduation()->latest()->get();
        return view ('changes.change-graduation', ['user'=>$user , 'graduations' => $graduation]);
    }


  
    //save the graduation changing information
    public function saveGraduationChanging(Request $request, User $user){
        
        //check wich part of graduation is empty
        if ((empty($request['university_name'])) && (empty($request['university_major'])) && (empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  "None";
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            Graduation::where('user_id',$user->id)->update($incomingFields);
            $id = $user->id;
            return redirect("/change-profile/$id");
        }

        //
        if ((empty($request['university_name'])) && (empty($request['university_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=>'string'
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            Graduation::where('user_id',$user->id)->update($incomingFields);
            $id = $user->id;
            return redirect("/change-profile/$id");
        }

//
        if ((empty($request['university_name'])) && (empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'university_major'=>'string'
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);

            $incomingFields['high_school_major'] =  "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            Graduation::where('user_id',$user->id)->update($incomingFields);
            $id = $user->id;
        return redirect("/change-profile/$id");
        }



        if(empty($request['high_school_major'])){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'university_major'=> 'string',
                'university_name'=> 'string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] = "None";
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/change-profile/$id")->with('message','Your graduation data have been saved!');
        }if ($request['university_major']){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=> 'string',

                'university_name'=> 'string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/choose-template/$id/resume")->with('message','Your graduation data have been saved!');
        }if(empty($request['university_name'])){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=> 'string',
                'university_major'=> 'string',

            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/change-profile/$id")->with('message','Your graduation data have been saved!');
        }
        

        $incomingFields = $request->validate([
            'level'=>'required|string',
            'high_school_major'=> 'string',
            'university_major'=> 'string',
            'university_name'=> 'string',
        ]);
        $incomingFields['level'] = strip_tags($incomingFields['level']);
        $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
        $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
        $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
        $incomingFields['user_id'] = auth()->id();
        Graduation::create($incomingFields);
        $id = $user->id;
        return redirect("/change-profile/$id")->with('message','Your graduation data have been saved!');




























        Graduation::where('user_id',$user->id)->update($incomingFields);
        $id = $user->id;
        return redirect("/change-profile/$id");

    }



    //show the experience changig page
    public function showChangeExperienceInfo(User $user){
        $experience = $user->experience()->latest()->get();
        return view ('changes.change-experience', ["user"=>$user , 'experiences' => $experience]);
    }


    //save the experieince change 
    public function saveExperienceChanging(Request $request, User $user){
       
        $id = $user->id;
        if(empty(($request['body']))){
            return redirect("/change-profile/$id")->with('failure','Your work experience is empty!');
        }else{
            $incomingFields = $request->validate([
                'body'=>'string'
            ]);
            $incomingFields['body'] = strip_tags($incomingFields['body']);
            $incomingFields['user_id'] = auth()->id();
            
            Experience::where('user_id',$user->id)->update($incomingFields);
            $id = $user->id;
            return redirect("/change-profile/$id");
        }

        return redirect("/create-cv-form/$id/graduation")->with('message','Your work experience data have been saved!');







    }

    //show changing template form
    public function showChangeTemplateInfo(User $user){
        return view('templates.template-page' , ['user'=>$user]);
    }

    public function showChangePasswordInfo(User $user){
        return view('changes.change-password', ['user'=>$user]);
    }
    //change the password and save in database
    public function savePasswordChanging(Request $request, User $user){
        $incomingFields = $request->validate([
            'password'=>['required','confirmed','min:6']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        User::where('id',$user->id)->update($incomingFields);
        $id = $user->id;
        return redirect("/change-profile/$id");   
    }

    //see the forget password page
    public function showForgetPassPage(User $user){
        return view('forget.froget-password' , ['user'=>$user]);
    }

    //change the password

    public function changeTheForgetPassword(Request $request, User $user){
        $incomingFields = $request->validate([
            'email'=>['required','email'],
            'password'=>['required','min:6'],
            'first_high_school_name'=>['required']

         ]);
         $email = DB::table('users')->select('email')->get();
        
         if($incomingFields['email'] == $email){
            $first_high_school_name = DB::table('users')->where('email', $incomingFields['email'])->value('first_high_school_name');
         }else{
            return redirect('/')->with('failure' , 'You cannot change the password because you enter wrong data!');
         }
         if($first_high_school_name == $incomingFields['first_high_school_name']){
            $incomingFields['password'] = bcrypt($incomingFields['password']);
            User::where('first_high_school_name',$incomingFields['first_high_school_name'])->update($incomingFields);
            return redirect('/')->with('message' , 'You changes the password successfully!');

        }else{
            return redirect('/')->with('failure' , 'You cannot change the password because you enter wrong data!');
        }

    }
    //show for deleting the skill

    public function deleteSkills(Skill $skill , User $user){
        $id = $user->id;
        
        if($user->cannot('delete' , $skill)){
            return redirect("/create-cv-form/$id/skills")->with('failure','It cannot be deleted!');
        }else{
            $skill->delete();
            return redirect("/create-cv-form/$id/skills")->with('message','The skill successfully deleted!');

        }
    }

    //deleting skills in change mode
    public function deleteSkillsChange(Skill $skill , User $user){
        $id = $user->id;
        
        if($user->cannot('delete' , $skill)){
            return redirect("/create-cv-form/$id/edit/skill")->with('failure','It cannot be deleted!');
        }else{
            $skill->delete();
            return redirect("/create-cv-form/$id/edit/skill")->with('message','The skill successfully deleted!');

        }
    }


    //edit form for skills
    public function updateSkillsForm(Skill $skill , User $user){
        return view ('changes.edit-skill-page' , ['skill'=> $skill ,'user'=> $user ]);
    }

    //save edit skills
    public function saveUpdateSkills(Request $request, Skill $skill , User $user){
        $request['level'] = strip_tags($request['level']);
        $request['high_school_major'] = strip_tags($request['high_school_major']);
        $id = $user->id;
        if($skill){
            $skill->title = $request->title;
            $skill->body = $request->body;
            $skill->save();
            return redirect("/create-cv-form/$id/skills")->with('message','Congrats! you edited the skill successfully!') ; 
        }else{
            return redirect("/create-cv-form/$id/skills")->with('failure','You cannot edit the skill!') ; 

        }
    }

    //edit skills in change mode
    public function updateSkillsFormCahnge(Skill $skill , User $user){
        return view ('changes.edit-skill-page-change-skill' , ['skill'=> $skill ,'user'=> $user ]);
    }
    //save edit skills in change mode
    public function saveUpdateSkillsChange(Request $request, Skill $skill , User $user){
        $request['level'] = strip_tags($request['level']);
        $request['high_school_major'] = strip_tags($request['high_school_major']);
        $id = $user->id;
        if($skill){
            $skill->title = $request->title;
            $skill->body = $request->body;
            $skill->save();
            return redirect("/create-cv-form/$id/edit/skill")->with('message','Congrats! you edited the skill successfully!') ; 
        }else{
            return redirect("/create-cv-form/$id/edit/skill")->with('failure','You cannot edit the skill!'); 

        }
    }







    //graduation edit


    public function deleteGraduation(Graduation $graduation , User $user){
        $id = $user->id;
        
        if($user->cannot('delete' , $graduation)){
            return redirect("/create-cv-form/$id/graduation")->with('failure','It cannot be deleted!');
        }else{
            $graduation->delete();
            return redirect("/create-cv-form/$id/graduation")->with('message','The graduation successfully deleted!');

        }
    }

    //deleting skills in change mode
    public function deleteGraduationChange(Graduation $graduation , User $user){
        $id = $user->id;
        
        if($user->cannot('delete' , $graduation)){
            return redirect("/create-cv-form/$id/edit/graduation")->with('failure','It cannot be deleted!');
        }else{
            $graduation->delete();
            return redirect("/create-cv-form/$id/edit/graduation")->with('message','The graduation successfully deleted!');

        }
    }


    //edit form for skills
    public function updateGraduationForm(Graduation $graduation , User $user){
        return view ('changes.edit-graduation-page' , ['graduations'=> $graduation ,'user'=> $user ]);
    }

    //save edit skills
    public function saveUpdateGraduation(Request $request, Graduation $graduation , User $user){
        $id = $user->id;


          
        //check wich part of graduation is empty
        if ((empty($request['university_name'])) && (empty($request['university_major'])) && (empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  "None";
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                return redirect("/create-cv-form/$id/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 
            }else{
                return redirect("/create-cv-form/$id/graduation")->with('failure','You cannot edit the graduation!') ; 
    
            }
        }

        //
        if ((empty($request['university_name'])) && (empty($request['university_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=>'string'
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                return redirect("/create-cv-form/$id/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 
            }else{
                return redirect("/create-cv-form/$id/graduation")->with('failure','You cannot edit the graduation!') ; 
    
            }
        }

//
        if ((empty($request['university_name'])) && (empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'university_major'=>'string'
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);

            $incomingFields['high_school_major'] =  "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                return redirect("/create-cv-form/$id/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 
            }else{
                return redirect("/create-cv-form/$id/graduation")->with('failure','You cannot edit the graduation!') ; 
    
            }
        }



        if(empty($request['high_school_major'])){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'university_major'=> 'string',
                'university_name'=> 'string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] = "None";
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();


            if($graduation){
                $graduation->update($incomingFields);
                return redirect("/create-cv-form/$id/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 
            }else{
                return redirect("/create-cv-form/$id/graduation")->with('failure','You cannot edit the graduation!') ; 
    
            }
        }
            if ($request['university_major']){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=> 'string',

                'university_name'=> 'string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                return redirect("/create-cv-form/$id/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 
            }else{
                return redirect("/create-cv-form/$id/graduation")->with('failure','You cannot edit the graduation!') ; 
    
            }
        }if(empty($request['university_name'])){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=> 'string',
                'university_major'=> 'string',

            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                return redirect("/create-cv-form/$id/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 
            }else{
                return redirect("/create-cv-form/$id/graduation")->with('failure','You cannot edit the graduation!') ; 
    
            }
        }
        

        $incomingFields = $request->validate([
            'level'=>'required|string',
            'high_school_major'=> 'string',
            'university_major'=> 'string',
            'university_name'=> 'string',
        ]);
        $incomingFields['level'] = strip_tags($incomingFields['level']);
        $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
        $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
        $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
        $incomingFields['user_id'] = auth()->id();
        if($graduation){
            $graduation->update($incomingFields);
            return redirect("/create-cv-form/$id/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 
        }else{
            return redirect("/create-cv-form/$id/graduation")->with('failure','You cannot edit the graduation!') ; 

        }

    }

    //edit skills in change mode
    public function updateGraduationFormCahnge(Graduation $graduation , User $user){
        return view ('changes.edit-skill-page-change-skill' , ['skill'=> $graduation ,'user'=> $user ]);
    }
    //save edit skills in change mode
    public function saveUpdateGraduationChange(Request $request, Graduation $graduation , User $user){
        $id = $user->id;


          
        //check wich part of graduation is empty
        if ((empty($request['university_name'])) && (empty($request['university_major'])) && (empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  "None";
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                            return redirect("/create-cv-form/$id/edit/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 

            }else{
                 return redirect("/create-cv-form/$id/edit/graduation")->with('failure','You cannot edit the graduation!'); 
    
            }
        }

        //
        if ((empty($request['university_name'])) && (empty($request['university_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=>'string'
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                            return redirect("/create-cv-form/$id/edit/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 

            }else{
                 return redirect("/create-cv-form/$id/edit/graduation")->with('failure','You cannot edit the graduation!'); 
    
            }
        }

//
        if ((empty($request['university_name'])) && (empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'university_major'=>'string'
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);

            $incomingFields['high_school_major'] =  "None";
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                            return redirect("/create-cv-form/$id/edit/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 

            }else{
                 return redirect("/create-cv-form/$id/edit/graduation")->with('failure','You cannot edit the graduation!'); 
    
            }
        }



        if(empty($request['high_school_major'])){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'university_major'=> 'string',
                'university_name'=> 'string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] = "None";
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();


            if($graduation){
                $graduation->update($incomingFields);
                            return redirect("/create-cv-form/$id/edit/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 

            }else{
                 return redirect("/create-cv-form/$id/edit/graduation")->with('failure','You cannot edit the graduation!'); 
    
            }
        }
            if ($request['university_major']){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=> 'string',

                'university_name'=> 'string',
            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = "None";
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                            return redirect("/create-cv-form/$id/edit/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 

            }else{
                 return redirect("/create-cv-form/$id/edit/graduation")->with('failure','You cannot edit the graduation!'); 
    
            }
        }if(empty($request['university_name'])){
            $incomingFields = $request->validate([
                'level'=>'required|string',
                'high_school_major'=> 'string',
                'university_major'=> 'string',

            ]);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = "None";
            $incomingFields['user_id'] = auth()->id();
            if($graduation){
                $graduation->update($incomingFields);
                            return redirect("/create-cv-form/$id/edit/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 

            }else{
                 return redirect("/create-cv-form/$id/edit/graduation")->with('failure','You cannot edit the graduation!'); 
    
            }
        }
        

        $incomingFields = $request->validate([
            'level'=>'required|string',
            'high_school_major'=> 'string',
            'university_major'=> 'string',
            'university_name'=> 'string',
        ]);
        $incomingFields['level'] = strip_tags($incomingFields['level']);
        $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
        $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
        $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
        $incomingFields['user_id'] = auth()->id();
        if($graduation){
            $graduation->update($incomingFields);
                        return redirect("/create-cv-form/$id/edit/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 

        }else{
             return redirect("/create-cv-form/$id/edit/graduation")->with('failure','You cannot edit the graduation!'); 

        }
    }
}

        

  
   


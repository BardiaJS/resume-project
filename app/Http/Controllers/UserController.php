<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'username'=>['required','min:3','max:12' , 'regex:/^[a-zA-Z0-9]+$/'],
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

   

  
    
   

    // show the template for resume
    public function showTemplates(User $user){
        
        if($user->wichTeplate > 0){
            return redirect('/')->with('message','information saved!');
        }else{
            return view('templates.template-page', ['user'=>$user]);
        }
    }


    //show the first template
    public function showFirstTemplate(User $user){
        $skillData =(bool)DB::table('skills')->where('user_id', auth()->id())->first();       
        $graduationData = (bool)DB::table('graduations')->where('user_id', auth()->id())->first();      
        
        $id = auth()->id();
        $personal = $user->personal;
        $skill = $user->skill()->latest()->get();
        $experience = $user->experience()->latest()->get();
        $graduation =  $user->graduation()->latest()->get();
        $user->isCreateCV = 1;
        $user->wichTeplate = 1;
        $user->save();

        return view('templates.first-template', ['user'=>$user , 'personal' => $personal , 'skills' => $skill , 'experiences' => $experience , 'graduations' => $graduation , 'skillData' => $skillData , 'graduationData' => $graduationData]);

    }

       //show the second template
       public function showSecondTemplate(User $user){
        $skillData =(bool)DB::table('skills')->where('user_id', auth()->id())->first();       
        $graduationData = (bool)DB::table('graduations')->where('user_id', auth()->id())->first(); 
        $id = auth()->id();
        $personal = $user->personal;
        $skill = $user->skill()->latest()->get();
        $experience = $user->experience()->latest()->get();
        $graduation =  $user->graduation()->latest()->get();
        $user->isCreateCV = 1;
        $user->wichTeplate = 2;
        $user->save();

        return view('templates.second-template', ['user'=>$user , 'personal' => $personal , 'skills' => $skill , 'experiences' => $experience , 'graduations' => $graduation , 'skillData' => $skillData , 'graduationData' => $graduationData]);

    }

       //show the third template
       public function showThirdTemplate(User $user){
        $skillData =(bool)DB::table('skills')->where('user_id', auth()->id())->first();       
        $graduationData = (bool)DB::table('graduations')->where('user_id', auth()->id())->first(); 
        $id = auth()->id();
        $personal = $user->personal;
        $skill = $user->skill()->latest()->get();
        $experience = $user->experience()->latest()->get();
        $graduation =  $user->graduation()->latest()->get();
        $user->isCreateCV = 1;
        $user->wichTeplate = 3;
        $user->save();
        return view('templates.third-template', ['user'=>$user , 'personal' => $personal , 'skills' => $skill , 'experiences' => $experience , 'graduations' => $graduation ,'skillData' => $skillData , 'graduationData' => $graduationData]);

    }

       //show the fourth template
       public function showFourthTemplate(User $user){
        $skillData =(bool)DB::table('skills')->where('user_id', auth()->id())->first();       
        $graduationData = (bool)DB::table('graduations')->where('user_id', auth()->id())->first(); 
        $id = auth()->id();
        $personal = $user->personal;
        $skill = $user->skill()->latest()->get();
        $experience = $user->experience()->latest()->get();
        $graduation =  $user->graduation()->latest()->get();
        $user->isCreateCV = 1;
        $user->wichTeplate = 4;
        $user->save();
        return view('templates.fourth-template', ['user'=>$user , 'personal' => $personal , 'skills' => $skill , 'experiences' => $experience , 'graduations' => $graduation , 'skillData' => $skillData , 'graduationData' => $graduationData]);

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
            'username'=>['required','regex:/^[a-zA-Z0-9]+$/'],
            'email'=>['required','email',Rule::unique('users' , 'email')]
        ]);
        $user->update($incomingFields);
        $user->save();
        $id = $user->id;
        return redirect("/change-profile/$id");         
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
   






   
}

        

  
   


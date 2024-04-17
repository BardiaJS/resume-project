<?php

namespace App\Http\Controllers;

use App\Models\Information;
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
            return redirect('/')->with('alert' , 'Invalid data!');
        }
    }

    //show cv form
    public function showPersonalCVForm(User $user){
        return view('personal-cv-form' , ['user'=>$user]);
    }

    //set the personal cv data to database and going next step
    public function getPersonalCV(Request $request , User $user){
        $incomingFields = $request->validate([
            'name'=>['required'],
            'familyName'=>['required'],
            'age'=>['required'],
            'gender'=>['required'],
            'military'=>['required'],
        ]);
        Information::create($incomingFields);
        $id = $user->id();
        return redirect("/create-cv-form/$id/skills")->with('message','Your personal data hav been saved!');
    }


}

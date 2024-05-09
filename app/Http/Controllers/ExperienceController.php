<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    //
      // show the work experience form 
      public function showWorkExpCVForm(User $user){

        $data =(bool)DB::table('experiences')->where('user_id', auth()->id())->first();       
        if($data){
            return view('resume.graduation-cv-form' , ['user'=>$user , 'graduations' => $user->graduation()->latest()->get()]);
        }else{
            return view('resume.work-experience-cv-form', ['user'=>$user]);
        }

    // }else{
    //     return view('resume.personal-cv-form' , ['user'=>$user]);
    // }
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
            return redirect("/change-profile/$id")->with("message" ,"Changes have been saved!");
        }

    }

}

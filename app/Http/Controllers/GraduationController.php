<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Graduation;
use Illuminate\Http\Request;

class GraduationController extends Controller
{
    //
     // show the graduation form 
     public function showGraduationCVForm(User $user){
        return view('resume.graduation-cv-form', ['user'=>$user , 'graduations' => $user->graduation()->latest()->get()]);
    }

    // set the graduation form info to database
    public function getGraduationCV(Request $request , User $user){

        //check wich part of graduation is empty
        if ((empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required',
                'university_major'=>'required',
                'university_name' => 'required'
            ]);
         
            $incomingFields['high_school_major'] = "None";
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        }else{
            $incomingFields = $request->validate([
                'level'=>'required',
                'university_major'=>'required',
                'university_name' => 'required',
                'high_school_major' => 'required'
            ]);
            $incomingFields['high_school_major'] = strip_tags($incomingFields['high_school_major']);
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/create-cv-form/$id/graduation")->with('message','Your graduation data have been saved!');
        }
        
    }

    //show the graduation changing page
    public function showChangeGraduationInfo(User $user){
        $graduation =  $user->graduation()->latest()->get();
        return view ('changes.change-graduation', ['user'=>$user , 'graduations' => $graduation]);
    }


  
    //save the graduation changing information
    public function saveGraduationChanging(Request $request, User $user){
        
        //check wich part of graduation is empty
        
        if ((empty($request['high_school_major']))){
            $incomingFields = $request->validate([
                'level'=>'required',
                'university_major'=>'required',
                'university_name' => 'required'
            ]);
         
            $incomingFields['high_school_major'] =  "None";
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/create-cv-form/$id/edit/graduation")->with('message' ,'Completed!');
        }else{
            $incomingFields = $request->validate([
                'level'=>'required',
                'university_major'=>'required',
                'university_name' => 'required'
            ]);
            $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);;
            $incomingFields['level'] = strip_tags($incomingFields['level']);
            $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
            $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
            $incomingFields['user_id'] = auth()->id();
            Graduation::create($incomingFields);
            $id = $user->id;
            return redirect("/create-cv-form/$id/edit/graduation")->with('message' ,'Completed!');
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

//deleting graduation in change mode
public function deleteGraduationChange(Graduation $graduation , User $user){
    $id = $user->id;
    
    if($user->cannot('delete' , $graduation)){
        return redirect("/create-cv-form/$id/edit/graduation")->with('failure','It cannot be deleted!');
    }else{
        $graduation->delete();
        return redirect("/create-cv-form/$id/edit/graduation")->with('message','The graduation successfully deleted!');

    }
}


//edit form for graduation
public function updateGraduationForm(Graduation $graduation , User $user){
    return view ('changes.edit-graduation-page' , ['graduation'=> $graduation ,'user'=> $user ]);
}

//save edit graduation
public function saveUpdateGraduation(Request $request, Graduation $graduation , User $user){
    $id = $user->id;
    if ((empty($request['high_school_major']))){
        $incomingFields = $request->validate([
            'level'=>'required',
            'university_major'=>'required',
            'university_name' => 'required'
        ]);
     
        $incomingFields['high_school_major'] =  "None";
        $incomingFields['level'] = strip_tags($incomingFields['level']);
        $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
        $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
        $incomingFields['user_id'] = auth()->id();
        if($graduation){
            $graduation->update($incomingFields);
            return redirect("/create-cv-form/$id/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 
        }else{
            return redirect("/create-cv-form/$id/graduation")->with('failure','You cannot edit the graduation!') ; 

        }       
        
    }else{
        $incomingFields = $request->validate([
            'level'=>'required',
            'university_major'=>'required',
            'university_name' => 'required',
            'high_school_major' => 'required'
        ]);
        $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);;
        $incomingFields['level'] = strip_tags($incomingFields['level']);
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


}

//edit graduation in change mode
public function updateGraduationFormCahnge(Graduation $graduation , User $user){
    return view ('changes.edit-graduation-page-change-graduation' , ['graduation'=> $graduation ,'user'=> $user ]);
}
//save edit graduation in change mode
public function saveUpdateGraduationChange(Request $request, Graduation $graduation , User $user){
    $id = $user->id;

    if ((empty($request['high_school_major']))){
        $incomingFields = $request->validate([
            'level'=>'required',
            'university_major'=>'required',
            'university_name' => 'required'
        ]);
     
        $incomingFields['high_school_major'] =  "None";
        $incomingFields['level'] = strip_tags($incomingFields['level']);
        $incomingFields['university_major'] = strip_tags($incomingFields['university_major']);
        $incomingFields['university_name'] = strip_tags($incomingFields['university_name']);
        $incomingFields['user_id'] = auth()->id();
        if($graduation){
            $graduation->update($incomingFields);
                        return redirect("/create-cv-form/$id/edit/graduation")->with('message','Congrats! you edited the graduation successfully!') ; 

        }else{
            return redirect("/create-cv-form/$id/edit/graduation")->with('failure','You cannot edit the graduation!'); 

        }            
        
    }else{
        $incomingFields = $request->validate([
            'level'=>'required',
            'university_major'=>'required',
            'university_name' => 'required'
        ]);
        $incomingFields['high_school_major'] =  strip_tags($incomingFields['high_school_major']);;
        $incomingFields['level'] = strip_tags($incomingFields['level']);
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
}

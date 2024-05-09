<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    //show skill cv form
    public function showSkillsCVForm(User $user){
        return view('resume.skills-cv-form', ['user'=>$user , 'skills' => $user->skill()->latest()->get()]);
    }



    //set the skill cv data to database and going next step
    public function getSkillCV(Request $request , User $user){  
        $incomingFields = $request->validate([
            'title'=> 'required',
            'body'=> 'required',
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Skill::create($incomingFields);
        $id = $user->id;
        return redirect("/create-cv-form/$id/skills")->with('message','Your skill data have been saved!');
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


}

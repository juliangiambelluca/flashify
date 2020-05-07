<?php

namespace App\Http\Controllers;

use App\Set;
use Illuminate\Http\Request;



class SetController extends Controller
{
    public function getMySets(){
        $sets = Set::paginate(4);



        return view('pages.my-sets',  ["sets" => $sets]);
    }

    public function prepEditor($setID = -1){   
        //YOU MUST ALSO GET A USER TOKEN IN FUTURE
        if($setID === -1){
            //Nothing passed, if user tries to access -1 it gets treated as a string.
            //Create a new empty set
            $set = new Set([]);
            $set->save();
            $currentID = $set->id;
            return redirect('editor/' . $currentID);
        } else {
            //Check ID and if set exists
            $set = Set::find($setID);   

            if($set->title !== null){ 
            //Set exists and has data
                //Load cards if they exist
                if(isset($set->flashcards)){
                    $flashcards = $set->flashcards;
                };
                return view('pages.editor' , ["set" => $set, "flashcards" => $flashcards]);
            } else if (isset($set->id)) {
            //Empty set has been prepared, show editor.
                return view('pages.editor' , ["set" => $set]);
            } else {
                //Set passed was not found
                return("404, Card not found");
            }
        }
    }

    public function createSet(Request $request){

        $attributeNames = array(
            'fc-set-title' => 'Title',
            'fc-set-desc' => 'Description',
            'fc-set-color' => 'Color',
        );
        $customMessages = array();
        $rules = array(
        'fc-set-title' => 'required|min:3|max:64',
            'fc-set-desc' => 'required|min:3|max:256',
            'fc-set-color' => ['required', 'regex:/^rgb\((?:([0-9]{1,2}|1[0-9]{1,2}|2[0-4][0-9]|25[0-5]), ?)(?:([0-9]{1,2}|1[0-9]{1,2}|2[0-4][0-9]|25[0-5]), ?)(?:([0-9]{1,2}|1[0-9]{1,2}|2[0-4][0-9]|25[0-5]))\)$/i']
        );

        $this->validate($request, $rules, $customMessages, $attributeNames);
        

        $set = new Set([
            'title' => $request->input('fc-set-title') ,
            'description' => $request->input('fc-set-desc'),
            'color' => $request->input('fc-set-color'),
        ]);

        $oldSet = Set::find($request->input('fc-set-id'));

        if (isset($oldSet->id)){
            $oldSet->title = $request->input('fc-set-title');
            $oldSet->description = $request->input('fc-set-desc');
            $oldSet->color = $request->input('fc-set-color');
            $oldSet->save();
            $currentID = $oldSet->id;
            $newTitle = $oldSet->title;
        }else{
            $set->save();
            $currentID = $set->id;
            $newTitle = $set->title;
        };

        $response = array(
            "result" => "success",
            "setID" => $currentID,
            "setTitle" => $newTitle,
            );
     
        return($response);

    }

}

<?php

namespace App\Http\Controllers;

use App\Flashcard;
use App\Http\Requests;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{   

    public function createCards(Request $request){

        $cardCount = $request->input('cardCount');

        $rules = array();

        for ($i = 0; $i <= $cardCount; $i++){
        $rules['fc-edit-front-' . $i] = "required|max:512";
        $rules['fc-edit-back-' . $i] = "required|max:512";
        };
        $attributeNames = array();
        $customMessages = array();

        $this->validate($request, $rules, $customMessages, $attributeNames);

        $set = new Set();

        for ($i = 0; $i <= $cardCount; $i++){
            
            $oldCard = Flashcard::find()


        }



        $oldSet = Set::find($request->input('fc-set-id'));

        if (isset($oldSet->id)){
            $oldSet->title = $request->input('fc-set-title');
            $oldSet->description = $request->input('fc-set-desc');
            $oldSet->onfeed = $onFeedChecked;
            $oldSet->ispublic = $isPublicChecked;
            $oldSet->save();
            $currentID = $oldSet->id;
        }else{
            $set->save();
            $currentID = $set->id;
        }

        return ("success," . $currentID) ;
    }
}

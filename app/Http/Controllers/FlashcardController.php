<?php

namespace App\Http\Controllers;

use App\Flashcard;
use App\Set;
use App\Http\Requests;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{   

    public function createCards(Request $request){
        
        $cardCount = $request->input('cardCount');
        $currentSetID = $request->input('setID');
        //Validate inputs
        $rules = array();
        for ($i = 0; $i < $cardCount; $i++){
        $rules['fc-edit-front-' . $i] = "required|max:512";
        $rules['fc-edit-back-' . $i] = "required|max:512";
        };
        $customMessages = array(
            'required' => 'Please make sure there are no empty cards.',
            'max' => 'Please make sure each card is under 512 characters per side.',
        );
        $this->validate($request, $rules, $customMessages);

        //Update or insert inputs
        $newCardIDs = array();
        $oldSet = Set::find($currentSetID);

        if (isset($oldSet->title)){
            //Expected behaviour. Card Should have been already created and its ID passed.
            for ($i = 0; $i < $cardCount; $i++){
                $currentCardDBID = $request->input('fc-db-id-' . $i);
                $oldFlashcard = Flashcard::find($currentCardDBID);

                if (isset($oldFlashcard->front)){
                    //Card was already created before. Update it.
                    $oldFlashcard->front = $request->input('fc-edit-front-' . $i);
                    $oldFlashcard->back = $request->input('fc-edit-back-' . $i);
                    $oldSet->flashcards()->save($oldFlashcard);
                } else {
                    //Card doesn't already exist. Insert it.
                    $flashcard = new Flashcard([
                        'front' => $request->input('fc-edit-front-' . $i),
                        'back' => $request->input('fc-edit-back-' . $i),
                    ]);
                    $oldSet->flashcards()->save($flashcard);
                    $newCardIDs['fc-db-id-' . $i] = $flashcard->id;
                }
            };
            $result = "success";
        }else{
            //Unexpected behaviour. Set cannot be found.
            $result = "unexpected";
        }

        $response = array(
            "result" => $result,
            "newCardIDs" => $newCardIDs
        );
     
        return ($response);
    }
}

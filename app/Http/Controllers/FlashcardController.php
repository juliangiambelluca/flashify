<?php

namespace App\Http\Controllers;

use App\Flashcard;
use App\Set;
use App\Http\Requests;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{   
    
    public function deleteCard(Request $request){

        $currentCardDBID = $request->input('deleteID');
        $oldFlashcard = Flashcard::find($currentCardDBID);

        if ((isset($oldFlashcard->front))||(isset($oldFlashcard->back))){
            $oldFlashcard->delete();
            return ("deleted");
        } else {
            return ("not-saved");
        }

    }


    public function createCards(Request $request){
        
        $currentSetID = $request->input('setID');
        $cardsToValidate = $request->input('idsToValidate');

        if($cardsToValidate === null){
            $response = array(
                "result" => "no-card-sent"
            );
           return($response);
        }

        $cardCount = count($cardsToValidate);
        
        //Validate inputs
        $rules = array();
        for ($i = 0; $i < $cardCount; $i++){
        $rules['fc-edit-front-' . $cardsToValidate[$i]] = "max:512";
        $rules['fc-edit-back-' . $cardsToValidate[$i]] = "max:512";
        };

        $customMessages = array(
            // 'required' => 'Please make sure there are no empty cards.',
            'max' => 'Please make sure each card is under 512 characters per side.',
        );
        $this->validate($request, $rules, $customMessages);

        //Update or insert inputs
        $newCardIDs = array();
        $oldSet = Set::find($currentSetID);

        if (isset($oldSet->title)){
            $result = "success";

            //Expected behaviour. Card Should have been already created and its ID passed.
            for ($i = 0; $i < $cardCount; $i++){
                //Some cards may be deleted. If input doesnt exist, skip this iteration.
                if ((null !== ($request->input('fc-edit-front-' . $cardsToValidate[$i])))||(null !== ($request->input('fc-edit-back-' . $cardsToValidate[$i])))){
                $currentCardDBID = $request->input('fc-db-id-' . $cardsToValidate[$i]);
                $oldFlashcard = Flashcard::find($currentCardDBID);

                    if ((isset($oldFlashcard->front))||(isset($oldFlashcard->back))){
                        //Card was already created before. Update it.
                        $oldFlashcard->front = $request->input('fc-edit-front-' . $cardsToValidate[$i]);
                        $oldFlashcard->back = $request->input('fc-edit-back-' . $cardsToValidate[$i]);
                        $oldSet->flashcards()->save($oldFlashcard);
                    } else {
                        //Card doesn't already exist. Insert it.
                        $flashcard = new Flashcard([
                            'front' => $request->input('fc-edit-front-' . $cardsToValidate[$i]),
                            'back' => $request->input('fc-edit-back-' . $cardsToValidate[$i]),
                        ]);
                        $oldSet->flashcards()->save($flashcard);
                        $newCardIDs['fc-db-id-' . $cardsToValidate[$i]] = $flashcard->id;
                    }
                };
            };
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

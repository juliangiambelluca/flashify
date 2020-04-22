<?php

namespace App\Http\Controllers;

use App\Flashcard;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class FlashcardController extends Controller
{
    public function listFlashcards(Store $session){
        $flashcard = new Flashcard();
        $flashcards = $flashcard->getFlashcards($session);
        return view('pages.viewer', compact("flashcards"));
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Set;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class SetController extends Controller
{
    public function getRecents(Store $session){
        $set = new Set();
        $sets = $set->getSets($session);
        return view('pages.dashboard', compact("sets"));
    }

    public function getMySets(Store $session){
        $set = new Set();
        $sets = $set->getSets($session);
        return view('pages.my-sets', compact("sets"));
    }
    
    public function listFlashcards(Store $session){
        $set = new Set();
        $sets = $set->getFlashcards($session);
        return view('pages.viewer', compact("flashcards"));
    }
    
    public function logout(Store $session){
        $set = new Set();
        $set->logout($session);
        return view('pages.my-sets');
    }

}

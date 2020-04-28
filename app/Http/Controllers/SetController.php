<?php

namespace App\Http\Controllers;

use App\Set;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Routing\Redirector;


class SetController extends Controller
{
    public function getRecents(Store $session){
        $set = new Set();
        $sets = $set->getSets($session);
        return view('pages.dashboard', compact("sets"));
    }

    public function getMySets(Store $session){
        $sets = Set::all();
        return view('pages.my-sets', compact("sets"));
    }


    
    public function logout(Store $session){
        $set = new Set();
        $set->logout($session);
        return view('pages.my-sets');
    }






    public function createSet(Request $request, Store $session){

        $attributeNames = array(
            'fc-set-title' => 'Title',
            'fc-set-desc' => 'Description',
            'fc-set-color' => 'Color',
            'fc-set-category' => 'Category',
            'fc-set-tags' => 'Tags',
        );
        $customMessages = array();
        $rules = array(
        'fc-set-title' => 'required|min:3|max:64',
            'fc-set-desc' => 'required|min:3|max:256',
            'fc-set-color' => ['required', 'regex:/^rgb\((?:([0-9]{1,2}|1[0-9]{1,2}|2[0-4][0-9]|25[0-5]), ?)(?:([0-9]{1,2}|1[0-9]{1,2}|2[0-4][0-9]|25[0-5]), ?)(?:([0-9]{1,2}|1[0-9]{1,2}|2[0-4][0-9]|25[0-5]))\)$/i'],
            'fc-set-category' => 'required|max:64',
            'fc-set-tags' => 'max:64'
        );

        $this->validate($request, $rules, $customMessages, $attributeNames);
        
        $onFeedChecked = $request->has('fc-set-onfeed');
        $isPublicChecked = $request->has('fc-set-ispublic');

        $set = new Set([
            'title' => $request->input('fc-set-title') ,
            'description' => $request->input('fc-set-desc'),
            'onfeed' => $onFeedChecked,
            'ispublic' => $isPublicChecked
        ]);
        $set->save();
        

        return view('pages.cards-editor', ["newSetInfo" => $set]);
    }

}

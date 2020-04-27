<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Set extends Model {

    protected $fillable = ['title', 'description', 'ispublic', 'onfeed'];

    public function getSets($session) {
        if(!$session->has('sets')){
            $this->createDummyData($session);
        }
        return $session->get('sets');
    }

    public function getMySets($session) {
        if(!$session->has('sets')){
            $this->createDummyData($session);
        }
        return $session->get('sets');
    }

    public function logout($session){
        session()->flush();
    }

    // public function validateSet(){
       

    //     if ($validation->fails()) {

    //         $inputs = $request->all();
    //         $errors = $validation;
    //         $response = array ("hello", "hi");
    //         return $response;

    //     } else {
    //         return "success";
    //         // $request->input('fc-set-title');
    //     }







    // }



    private function createDummydata($session){
        $sets = array(
            "ids" => array("333", "423", "543", "825", "222", "633", "791"),
            "titles" => array("Title 1"," Title 2"," Title 3"," Title 4"," Title 5"," Title 2"," Title 2"),
            "descriptions" => array("Desc 1"," Desc 2"," Desc 3"," Desc 4"," Desc 5"," Desc 2"," Desc 2"),
            "miniCards" => array(
                array("fc-1", "Who are the arctic monkeys", "How far is the moon?", "Where is France?"),
                array("fc-2", "What colour does red and blu make?", "Whats 2 + 4?", "Whats my name?"),
                array("fc-3", "Who are the arctic monkeys", "How far is the moon?", "Where is France?"),
                array("fc-4", "What colour does red and blu make?", "Whats 2 + 4?", "Whats my name?"),
                array("Whats Donald Trumps middle name?", "Who are the arctic monkeys", "How far is the moon?", "Where is France?"),
                array("Who was the president of the united States?", "What colour does red and blu make?", "Whats 2 + 4?", "Whats my name?"),
                array("Whats Donald Trumps middle name?", "Who are the arctic monkeys", "How far is the moon?", "Where is France?")
            ),
            "tags" => array(
                array("Science", "Maths", "Physics"),
                array("English", "Literature", "Poetry"),
                array("IT", "Science", "Maths"),
                array("English", "Literature", "Poetry"),
                array("Science", "Maths", "Physics"),
                array("English", "Literature", "Poetry"),
                array("English", "Literature", "Poetry")
            )
        );
        
        $session->put('sets', $sets);

    }


}
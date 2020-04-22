<?php

namespace App;

class Flashcard {

    public function getFlashcards($session) {
        if(!$session->has('flashcards')){
            $this->createDummyData($session);
        }
        return $session->get('flashcards');
    }

    private function createDummydata($session){
        $flashcards = array(
            "title" => "This set's title",
            "description" => "This set's description",
            "flashcardFronts" => array(
                "What is an Epilogue?", 
                "What are static characters?", 
                "Why is Friar John prevented from delivering his message to Romeo?", 
                "Why does Tybalt want to kill Romeo?"),
            "flashcardBacks" => array(
                "A speech or short poem addressed to the audience by one of the actors after the conclusion of a drama.", 
                "Characters that do not change over the course of the story.", 
                "He is quarantined in a plague house", 
                "Because Romeo sneaked into Capulet’s masquerade"),
        );
        
        $session->put('flashcards', $flashcards);

    }


}
<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Set extends Model {
    protected $fillable = ['title', 'description', 'onfeed', 'ispublic'];

    public function flashcards() {
        return $this->hasMany("App\Flashcard");
    }

}
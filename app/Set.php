<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Set extends Model {
    protected $fillable = ['title', 'description', 'color'];

    public function flashcards() {
        return $this->hasMany("App\Flashcard");
    }

}
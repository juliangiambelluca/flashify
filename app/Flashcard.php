<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model{

    protected $fillable = ['front', 'back'];

    public function set() {
        return $this->belongsTo("App\Set");
    }


}
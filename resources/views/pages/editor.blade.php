@extends('layouts.dash')

@section('page-title')
Flashcard Editor - Flashify
@endsection

@section("content")

<div id="set-editor-page" style="display: block;">
    @include('pages.set-editor')
</div>
<div id="cards-editor-page" style="display: none;">
    @include('pages.cards-editor')
</div>

<script>




//Confirm before leaving page to prevent data loss
window.onbeforeunload = function() {
    return true;
};

function showSetEditor () {
    $("#set-editor-page").fadeIn(750);
    $("#cards-editor-page" ).css( "display", "none" );
}
function showCardsEditor () {
    $( "#input-error-alert" ).css( "display", "none" );    
    $("#cards-editor-page").fadeIn(750);
    $( "#set-editor-page" ).css( "display", "none" );
}
 
</script>




@endsection
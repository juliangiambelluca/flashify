@extends('layouts.dash')

@section('page-title')
Flashcard Editor - Flashify
@endsection

@section("content")
<style id="set-color-styles">
<?php
$setColor = $set->color ?? "#4e73df";

$stylesToInsert = <<<EOD
    .set-left-border-color{
        border-left: 0.5rem solid $setColor !important;
        transition: 0.5s
    }
    .set-text-color, .set-text-color i{
        color: $setColor!important;
        transition: 0.5s
    }
    .set-color.flashcard-edit-front, .set-color.btn, .set-color.left-sidenav{
        background-color: $setColor !important;
        transition: 0.5s
    }
EOD;

echo $stylesToInsert;
?>

</style>


<div id="set-editor-page" style="display: block;">
    @include('pages.set-editor')
</div>
<div id="cards-editor-page" style="display: none;">
    @include('pages.cards-editor')
</div>

<script>

    //Makes text areas auto resize with input.
    $('textarea').each(function () {
  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
}).on('input', function () {
  this.style.height = 'auto';
  this.style.height = (this.scrollHeight) + 'px';
});


//Confirm before leaving page to prevent data loss
window.onbeforeunload = function() {
    saveCards();
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

    //addCard (bool:autoSave) 
    if(globalCardIDCounter===0){
        addCard(false)
    };
}


</script>




@endsection
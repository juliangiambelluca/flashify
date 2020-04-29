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
window.onbeforeunload = function() {
    return true;
};
function getInputs(){
    var setInputs = {};

    //Put all inputs into associative array
    $.each($('#create-set-form').serializeArray(), function(i, field) {
        setInputs[field.name] = field.value;
    });

    createSet(setInputs);
}

function createSet(setInputs){
    const sendPackage= () => {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '{{ route('create.set') }}',
                type: 'POST',
                dataType: "text",
                data: setInputs,
                success: function (response) {
                    resolve(response);
                },
                error: function (response) {
                    reject(response);
                },
            });
         });
    }


    sendPackage() .then(response => {
        if(response==="set-created"){
            //The inputs were correct & the data saved to the database  
            $("#cards-editor-page").fadeIn(750);
            $( "#set-editor-page" ).css( "display", "none" );    

        } else {
            alert("Weird response received")

        }
    })
    .catch(response => {

        if(response.status===422) {
            let responseObj = JSON.parse(response.responseText);

            
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html("");

            for (const property in responseObj) {
                $( "#input-errors" ).append( responseObj[property] + "<br>");
            }

        } else {
            //Something else went wrong
        console.log("Catch triggered. Response:");
        console.log(response);
        }
       
    });

}

function showSetEditor () {


    $("#set-editor-page").fadeIn(750);
    $( "#cards-editor-page" ).css( "display", "none" );


}


</script>




@endsection
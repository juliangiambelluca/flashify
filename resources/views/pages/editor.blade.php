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

        //Successful response looks like "success,123" where 123 is the current ID
        //It was much simpler to do this way than to receive an array from server.

        //Split response into success & ID
        let responseArray = response.split(",");

        if(responseArray[0]==="success"){

            //The inputs were correct & the data saved to the database  
            //Set current card's ID to enable updating db instead of insert
            document.getElementById("fc-set-id").value = responseArray[1];

            $( "#input-error-alert" ).css( "display", "none" );    
            $("#cards-editor-page").fadeIn(750);
            $( "#set-editor-page" ).css( "display", "none" );    

        } else {
            //Unexpected response from server
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html("Something went wrong. Please try again. [Details: Unexpected response from server]");

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
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html(`Something went wrong. Please try again. [Details: Exception Caught. HTTP status: ${response.status}]`);
        }
       
    });

}

function showSetEditor () {


    $("#set-editor-page").fadeIn(750);
    $( "#cards-editor-page" ).css( "display", "none" );


}


</script>




@endsection
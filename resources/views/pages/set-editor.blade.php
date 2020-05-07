<div class="row d-sm-flex align-items-center justify-content-between mb-0">
	<div class="col-md-8">
	<h1 class="h1 text-gray-800" style="word-break: break-all" id="set-title-set">
        @if($set->title !== null)
            Edit set
        @else
            Create a new set
        @endif
    </h1>
    </div>
</div>

<!-- Wrong inputs alert to be displayed by javascript -->
<div id="input-error-alert" class="row" style="display:none">
    <div class="col-md-6">
        <div class="alert border-left-danger alert-danger fade show" role="alert">
            <strong>Oops!</strong><br>
            <span id="input-errors"></span>
        </button>
        </div>
    </div>
</div>
  
<div class="row mb-5">
<!-- DEBUGGING RESPONSE -->
	<!-- <div id="set-debug" style="overflow-wrap: anywhere; "></div> -->

</div>

<form id="create-set-form" action="{{ route('create.set') }}" method="POST">
    <div class="row">

        <div class="col-md-7" style="margin-bottom: 33px;">
            @include('components.editor.set-edit')
        </div>

        <div class="col-md-5">
            @include('components.editor.set-options') 
            <!-- 
            Form input names created by the two includes above.
            fc-set-title
            fc-set-desc  
            fc-set-color = color in rgb format (rgb(78, 115, 223))
            fc-set-category = selected category as string
            fc-set-tags = a string containing comma separated tags
            fc-set-ispublic = boolean specifiying if this set should be publically available in search
            -->
            {{ csrf_field() }}
            <input type="hidden" id="fc-set-id" name="fc-set-id" value="{{ $set->id ?? '' }}">

            <div class="row mb-5">
                <div class="col-lg-9 col-xl-6">
                    <a onclick="createSet()" href="#">
                        <div class="card mb-5 set-left-border-color shadow hover-feedback py-2">
                            <div class="card-body" style="padding: 0.5rem">
                                <div class="row set-text-color no-gutters align-items-center">
                                    <div class="col-2 arrow-effect-right" style="text-align: center">
                                        <i class="fas fa-arrow-right " style="transform: scale(1.3)"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="h5 mb-0 font-weight-bold ">
                                            Save & Continue
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
	<br>
</div>


<script>

 /* This function will toggle an outline on the clicked colour button to show the user what colour they
have selected, and write the last selected colour into a hidden textfield in RGB format. */
function selectColor(selected){
    
    //Go through all elements in this document to see which ones matches all of these classes. Only one item should be returned.
    let x = document.getElementsByClassName("btn btn-circle btn-sm color-button-checked");
    let i;
    
    /* This will loop through all the elements found and stored in x. Only one or zero elements should usually be found
    This one element would usually be the last colour BUTTON to be clicked. */
    for (i = 0; i < x.length; i++) {
      //If any elements were passed to variable x, remove the class which gives the button its outline
      x[i].classList.remove("color-button-checked");
    }

    /* Now that no elements (colour buttons; usually the last one to be clicked) contain an outline, give the
    button that called this function an outline, to show the user what colour they have selected.*/
    selected.classList.add("color-button-checked")

    //Get the colour of the selected colour button and write that value to the hidden fc-set-color text field.
    newSetColor = selected.style.backgroundColor;
    document.getElementById("fc-set-color").value = newSetColor;

    newColorStyles = `
      .set-left-border-color{
          border-left: 0.5rem solid ${newSetColor} !important;
          transition: 300ms
      }
      .set-text-color, .set-text-color i{
          color: ${newSetColor}!important;
          transition: 150ms
      }
      .set-color.flashcard-edit-front, .set-color.btn, .set-color.sidebar-gradient{
          background-color: ${newSetColor} !important;
          transition: 600ms
      }
    `;
    $("#set-color-styles").html(newColorStyles)
}

function createSet(){
    
    //Get Inputs
    let setInputs = {};
    //Put all inputs into object
    $.each($('#create-set-form').serializeArray(), function(i, field) {
        setInputs[field.name] = field.value;
    });
    
    //Send to server
    const sendPackage= () => {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "{{ route('create.set') }}",
                type: 'POST',
                dataType: "text",
                data: setInputs,
                success: function (response) {
					// $( "#set-debug" ).html("Success! Response:<br>" + response + "<br><br>******<br><br>" + response.responseText);
                    resolve(response);
                    
                },
                error: function (response) {
					// $( "#set-debug" ).html("Success! Response:<br>" + response + "<br><br>******<br><br>" + response.responseText);

                    reject(response);
                },
            });
         });
    }


    sendPackage().then(response => {

        //Get resposnse
        let setResponseObj = JSON.parse(response);

        if(setResponseObj.result==="success"){
            
            //The inputs were correct & the data saved to the database  
            //Set current card's ID to enable updating db instead of insert
            document.getElementById("fc-set-id").value = setResponseObj.setID;
            $( "#set-title-set" ).html("Edit set");
            $( "#set-title-cards" ).html(setResponseObj.setTitle);
            
			showCardsEditor();

        } else {
            //Unexpected response from server
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html("Something went wrong. Please try again. [Details: Unexpected response from server]");

        }
    })
    .catch(response => {
        //If data validation fails, Laravel responds with status code 422 & Error messages in JSON.
        if(response.status===422) {
            let errorMsgsObj = JSON.parse(response.responseText);
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html("");

            //Extract each error message and append to alert
            for (const property in errorMsgsObj) {
                $( "#input-errors" ).append( errorMsgsObj[property] + "<br>");
            }
        } else {
            //Something else went wrong
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html(`Something went wrong. Please try again. [Details: Exception Caught. HTTP status: ${response.status}]`);
        }
    });
}


</script>

<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-6">
		<h1 class="h1 text-gray-800">
		the title innit
		</h1>
	</div>
	<div class="col-md-2">
		<a href="#" onclick="showSetEditor()">
			<div class="card-body hover-feedback" style="padding: 1.2rem 0.5rem 1rem 0.5rem">
				<div class="row no-gutters align-items-center">
					<div class="col-2 arrow-effect-left" style="text-align: center">
						<i class="fas fa-arrow-left text-secondary" style="transform: scale(1.3)"></i>
					</div>
					<div class="col-10">
						<div class="h5 mb-0 font-weight-bold text-secondary">
							Back to Card Set
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="col-lg-4">
		<a href="#">
			<div class="card border-left-primary hover-feedback shadow py-2">
				<div class="card-body" style="padding: 0.5rem">
					<div class="row no-gutters align-items-center">
						<div class="col-2" style="text-align: center">
							<i class="fas fa-save text-primary" style="transform: scale(1.3)"></i>
						</div>
						<div class="col-10">
							<div class="h5 mb-0 font-weight-bold text-primary">
								Save & View Card Set
							</div>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>

<!-- Padding row -->
<div class="row">
	<br>
</div>

<form id="create-cards-form">
	<div class="row">
		<div class="col-12" id="newCardsArea">
			<!-- Javascript to generate cards into here -->
			
@php
//In function to protect scope.

if(isset($flashcards)){
	prepCards($flashcards);
} else {
	echo "<script>let globalCardIDCounter = 0;</script>";
}


function prepCards($flashcards){

	$prepCardIDCounter = 0;

	foreach($flashcards as $flashcard){
		$currentCardID = $flashcard->id;
		$currentCardFront = $flashcard->front;
		$currentCardBack = $flashcard->back;

$cardToInsert = <<<EOD

<div class="row">
	<div class="col-md-6">
		<div class="card card-set shadow m-2 border-left-success hover-feedback-light">
			<div class="card-body">
				<div class="text-right" style="margin: -12px -10px">
					<a href="#" class="tool-tip">
						<span class="tool-tip-text">Delete card</span>
						<i class="fas fa-trash-alt fa-sm fa-fw text-danger"></i>
					</a>
				</div>
				<textarea 
				maxlength="512" placeholder="Edit front of card" rows="7"
				class="form-control transparent-input" 
				aria-describedby="fc-edit-front-help-$prepCardIDCounter" 
				id="fc-edit-front-$prepCardIDCounter" 
				name="fc-edit-front-$prepCardIDCounter">$currentCardFront</textarea> 
				<small class="form-text text-gray-500" id="fc-edit-front-help-$prepCardIDCounter">
					Max. 512 Characters.
				</small>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card card-set shadow m-2 border-left-info hover-feedback-light">
			<div class="card-body">
				<textarea 
				maxlength="512" placeholder="Edit back of card" rows="7"
				class="form-control transparent-input" 
				aria-describedby="fc-edit-back-help-$prepCardIDCounter" 
				id="fc-edit-back-$prepCardIDCounter" 
				name="fc-edit-back-$prepCardIDCounter">$currentCardBack</textarea> 
				<small class="form-text text-gray-500" id="fc-edit-back-help-$prepCardIDCounter">
					Max. 512 Characters.
				</small> 
			</div>
		</div>
	</div>
	<input type="hidden" name="fc-db-id-$prepCardIDCounter" value="$currentCardID">
</div>
<hr>
EOD;
		echo $cardToInsert; 
		$prepCardIDCounter++;
	}
	
echo "<script>let globalCardIDCounter = " . $prepCardIDCounter . ";</script>";
}


@endphp
		</div>
	</div>        
			
	<div class="row">
		<div class="col-12 text-center">
			<button class="btn btn-circle btn-lg btn-success hover-feedback m-5 tool-tip" onclick="addCard()" type="button">
				<span class="tool-tip-text">Add card</span><i class="fas fa-plus fa-sm"></i>
			</button>
			<br><br>
		</div>
	</div>
</form>


<!-- Padding row -->
<div class="row">
	<br>
</div>


<script>

if(globalCardIDCounter===0){addCard()};
function addCard(){
	const newCard = `
		<div class="col-md-6">
			@include('components.editor.fc-edit-front')
		</div>
		<div class="col-md-6">
			@include('components.editor.fc-edit-back')
		</div>
			`;
		

	let z = document.createElement('div');
	z.innerHTML = newCard;
	z.classList = "row"
	z.id = "flashcard-id-" + globalCardIDCounter;
	document.getElementById('newCardsArea').appendChild(z);

	let hr = document.createElement('hr');
	document.getElementById('newCardsArea').appendChild(hr);

	globalCardIDCounter++;

	$('html, body').animate({
	scrollTop: $("#" + z.id).offset().top
	},800);
}

function autoSave(){
	
	//Get Inputs
    let cardInputs = {};
    //Put all inputs into object
    $.each($('#create-cards-form').serializeArray(), function(i, field) {
        cardInputs[field.name] = field.value;
    });

    const sendPackage = () => {
		const currentSetID = document.getElementById("fc-set-id").value;
		cardInputs.setID = currentSetID;
		cardInputs.cardCount = globalCardIDCounter;

        return new Promise((resolve, reject) => {
            $.ajax({
                url: '{{ route("create.cards") }}',
                type: 'POST',
                dataType: "text",
				data: cardInputs,
                success: function (response) {
                    resolve(response);
                },
                error: function (response) {
                    reject(response);
                },
            });
         });
    }

    sendPackage().then(response => {

        if(response==="success"){

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

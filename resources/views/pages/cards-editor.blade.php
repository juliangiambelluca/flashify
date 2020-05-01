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
		<a href="#" onclick="saveCards()">
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



<!-- Wrong inputs alert to be displayed by javascript -->
<div id="cards-input-error-alert" class="row" style="display:none">
	<div class="col-md-6">
		<div class="alert border-left-danger alert-danger fade show" role="alert">
			<strong>Oops!</strong><br>
			<span id="cards-input-errors"></span>
		</button>
		</div>
	</div>
</div>



<!-- Padding row -->
<div class="row">
	<br>
	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
	<div id="debug" style="overflow-wrap: anywhere; "></div>
</div>

<form id="create-cards-form">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-12" id="newCardsArea">
			<!-- Javascript to generate cards into here -->
			
<?PHP
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
<div class="row" id="flashcard-id-$prepCardIDCounter">
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
?>
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

if(globalCardIDCounter===0){addCard(false)};

function addCard(autoSave = true){

	if(autoSave === true){saveCards();};

	const newCard = `
		<div class="col-md-6">
			@include('components.editor.fc-edit-front')
		</div>
		<div class="col-md-6">
			@include('components.editor.fc-edit-back')
		</div>
		<input type="hidden" name="fc-db-id-${globalCardIDCounter}" value="">
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

function saveCards(){

	//Get Inputs
    let cardInputs = {};
    $.each($('#create-cards-form').serializeArray(), function(i, field) {
        cardInputs[field.name] = field.value;
    });

	//Send inputs
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
					$( "#debug" ).html("Success! Response:<br>" + response + "<br><br>******<br><br>" + response.responseText);

                },
                error: function (response) {
                    reject(response);
					$( "#debug" ).html("Error. Response:<br>" + response + "<br><br>******<br><br>" + response.responseText);
                },
            });
         });
    }

    sendPackage().then(response => {
		let responseObj = JSON.parse(response);
        if(responseObj.result==="success"){
			//Clear error outline as inputs are now valid.
			$( ".error-outline" ).css( "border", "10px solid red" );

			//Set new card's database ID from response object.
			//This will inform laravel not to create a new card next time it sees it.
			for (const property in responseObj.newCardIDs) {
				//Property looks like fc-db-id-x
				//Property holds the ID of the hidden input that holds its respective card's database ID
				//Object property is the new Database ID for its respective card.
				$( "#" + property ).val(responseObj.newCardIDs[property]);
			}

            $("#cards-input-error-alert").css( "display", "none" );    

        } else {
            //Unexpected response from server
            $("#cards-input-error-alert").fadeIn(450);
            $( "#cards-input-errors" ).html("Something went wrong. Please try again. [Details: Unexpected response from server]");

        }
    })
    .catch(response => {
        //If data validation fails, Laravel responds with status code 422 & Error messages in JSON.
        if(response.status===422) {
            let errorMsgsObj = JSON.parse(response.responseText);
            $("#cards-input-error-alert").fadeIn(450);
            $( "#cards-input-errors" ).html("Please ensure no cards are empty and do not exceed 512 characters per side.");

            //Extract each error message and append to alert
            for (const property in errorMsgsObj) {
				$("#" + property).addClass("error-outline");  
            }

			$('html, body').animate({
			scrollTop: $("html").offset().top
			},800);

        } else {
            //Something else went wrong
            $("#cards-input-error-alert").fadeIn(450);
            $("#cards-input-errors" ).html(`Something went wrong. Please try again. [Details: Exception Caught. HTTP status: ${response.status}]`);
        }
    });
}



</script>

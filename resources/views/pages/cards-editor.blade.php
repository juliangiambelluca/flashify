<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-6">
		<h1 class="h1 text-gray-800" style="word-break: break-all" id="set-title-cards">
		{{ $set->title ?? 'Edit flashcards' }}
		</h1>
		<strong id="autosave-time">

		</strong>
	</div>
	<div class="col-10 col-sm-6 col-lg-2">
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
			<div class="card set-text-color set-left-border-color hover-feedback shadow py-2">
				<div class="card-body" style="padding: 0.5rem">
					<div class="row no-gutters align-items-center">
						<div class="col-2 " style="text-align: center">
							<i class="fas fa-save text-primary" style="transform: scale(1.3)"></i>
						</div>
						<div class="col-10">
							<div class="h5 mb-0 font-weight-bold">
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
	<!-- DEBUGGING RESPONSE -->
	<div id="debug" style="overflow-wrap: anywhere; "></div>
</div>





<form id="create-cards-form">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-12" id="newCardsArea">
			<!-- Javascript to generate cards into here -->
			
			@include("components.editor.fc-edit-preloader")

		</div>
	</div>        
			
	<div class="row">
		<div class="col-12 text-center">
			<button class="btn btn-circle btn-lg set-color hover-feedback m-5 tool-tip" onclick="addCard()" type="button">
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


	

let globalCardsOnScreen = globalCardIDCounter;


const showTimeSaved = () => {
	const date = new Date("date.toString(){{ $set->updated_at }} UTC");
	$("#autosave-time").html("Last edited: " + date.toLocaleString());
}; showTimeSaved();


function addCard(autoSave = true){




	if(autoSave === true){saveCards();};

	globalIDsToValidate.push(globalCardIDCounter);
	globalCardsOnScreen++;




	const newCard = `
		<div class="col-md-6">
			@include('components.editor.fc-edit-front')
		</div>
		<div class="col-md-6">
			@include('components.editor.fc-edit-back')
		</div>
		<input type="hidden" id="fc-db-id-${globalCardIDCounter}" name="fc-db-id-${globalCardIDCounter}" value="">
			`;
		

	let z = document.createElement('div');
	z.innerHTML = newCard;
	z.classList = "row";
	z.style.overflow ="hidden";
	z.id = "flashcard-id-" + globalCardIDCounter;
	document.getElementById('newCardsArea').appendChild(z);


	transitions.heightGrow(z, 150);

	// let hr = document.createElement('hr');
	// hr.id = "hr-id-" + globalCardIDCounter;
	// document.getElementById('newCardsArea').appendChild(hr);

	globalCardIDCounter++;

	$('html, body').animate({
	scrollTop: $("#" + z.id).offset().top
	},800);
 
     //Refresh text areas auto resize with input.
	$('textarea').each(function () {
  	this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
	}).on('input', function () {
  	this.style.height = 'auto';
	this.style.height = (this.scrollHeight) + 'px';
});


}

function saveCards(){

	//Get Inputs
    let cardInputs = {};
    $.each($('#create-cards-form').serializeArray(), function(i, field) {
        cardInputs[field.name] = field.value;
    });

	//Safely duplicate globalIDsToValidate
	let idsToValidate = JSON.parse(JSON.stringify(globalIDsToValidate));
	
	//Don't send empty completely empty cards to server.
	for(let i = 0; i <= globalCardIDCounter; i++){
		if((cardInputs["fc-edit-front-" + i] == "") && (cardInputs["fc-edit-back-" +i] == "")){
			delete cardInputs["fc-edit-front-" + i];
			delete cardInputs["fc-edit-back-" + i];
			delete cardInputs["fc-db-id-" + i];
			const indexOfDeleted = idsToValidate.indexOf(i);
			idsToValidate.splice(indexOfDeleted, indexOfDeleted + 1);  
		}
	}
	
	//Send inputs
    const sendPackage = () => {
		const currentSetID = document.getElementById("fc-set-id").value;
		cardInputs.setID = currentSetID;
		cardInputs.cardCount = globalCardIDCounter;
		cardInputs.idsToValidate = idsToValidate;

        return new Promise((resolve, reject) => {
            $.ajax({
                url: '{{ route("create.cards") }}',
                type: 'POST',
                dataType: "text",
				data: cardInputs,
                success: function (response) {
                    resolve(response);
					// $( "#debug" ).html("Success! Response:<br>" + response + "<br><br>******<br><br>" + response.responseText);

                },
                error: function (response) {
                    reject(response);
					// $( "#debug" ).html("Error. Response:<br>" + response + "<br><br>******<br><br>" + response.responseText);
                },
            });
         });
    }

    sendPackage().then(response => {
		let responseObj = JSON.parse(response);
        if(responseObj.result==="success" || "no-cards-sent"){
			$("#autosave-time").html("Autosaved at: " + new Date().toLocaleTimeString());

			//Clear error outline as inputs are now valid.
			$( ".error-outline" ).removeClass("error-outline");

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
            $( "#cards-input-errors" ).html("Each side can hold up to 512 characters, including line breaks (enter key).");

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

function clearInputError(input){
	input.classList.remove("error-outline");
}

function highlightDeletions(mouseHover, pairToHighlight){
	
	if(mouseHover){
		// Create stylesheet
		const style = document.createElement('style');
		style.innerHTML =
			`#${pairToHighlight} .card-body {	
				background-color: #ff000075;
				border-color: transparent!important;	
				}`;
		style.id = (pairToHighlight + "-highlight-style")
		// Get the first script tag
		const ref = document.querySelector('script');

		// Insert our new styles before the first script tag
		ref.parentNode.insertBefore(style, ref);
	} else {
		document.getElementById(pairToHighlight + '-highlight-style').outerHTML = "";
	}
}

var globalUndoTimer; 
function deleteCard(cardID){

	const indexOfDeleted = globalIDsToValidate.indexOf(cardID);
	globalIDsToValidate.splice(indexOfDeleted, indexOfDeleted + 1);  



	//get db id from card id
	const dbDeleteID = document.getElementById("fc-db-id-" + cardID).value;

	const sendPackage = () => {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '{{ route("delete.card") }}',
                type: 'POST',
                dataType: "text",
				data: {
        			"_token": "{{ csrf_token() }}",
        			"deleteID": dbDeleteID
     				},
                success: function (response) {
					// $( "#debug" ).html("Success! Response:<br>" + response + "<br><br>******<br><br>" + response.responseText);
                    resolve(response);
                },
                error: function (response) {
					// $( "#debug" ).html("Error. Response:<br>" + response + "<br><br>******<br><br>" + response.responseText);
                    reject(response);
                },
            });
         });
    }

    sendPackage().then(response => {
        if(response==="deleted" || response==="not-saved"){

			$("#fc-edit-back-" + cardID).removeAttr("name");
			$("#fc-edit-front-" + cardID).removeAttr("name");
			$("#fc-db-id-" + cardID).removeAttr("name");

			const deletedCard = document.getElementById("flashcard-id-" + cardID);
			const hr = document.getElementById("hr-id-" + cardID);
			const oldHeight = $(deletedCard).height() + "px";

			let undoButton = document.createElement('div');
			undoButton.style.transition = "0.5s"; 
			undoButton.style.opacity = "0%"; 
			undoButton.style.height = oldHeight;
			undoButton.style.width = "100%";
			undoButton.style.display = "table";
			undoButton.id = "card-undo-wrapper-" + cardID;
			undoButtonActionID = cardID;
			const undoButtonHTML = `
				<div class="row" style="height: 100%;">
					<div class="col-12">
						<table style="height: 100%; width: 100%;">
							<tr>
								<td style="width: 50%; text-align: right; padding-right:20px">
								<div>
									<h4>Card Deleted</h4>
									</div>
								</td>
								<td  style="width: 50%; padding-left: 30px;text-align: left">
									<button  type="button" class="btn btn-outline-success hover-feedback" onclick="undoDelete(${undoButtonActionID})"><strong>UNDO</strong></button>
								</td>
							</tr>
						</table>
					</div>
				</div>
			`;
			undoButton.innerHTML = undoButtonHTML;
		
			//delete transition
			deletedCard.style.opacity = "100%"; 
			deletedCard.style.transition = "0.2s"; 
			setTimeout(function(){deletedCard.style.opacity = "0%";}, 100);
			setTimeout(function(){
				deletedCard.parentNode.insertBefore( undoButton, deletedCard.nextSibling );
				deletedCard.style.display = "none";
				setTimeout(function(){
					
					undoButton.style.opacity = "100%"; 
					undoButton.style.height = "100px";

				}, 100);
			}, 200);
			
			globalUndoTimer = setTimeout(function(){
				undoButton.style.transition = "0.5s";
				undoButton.style.height = "0px";
				undoButton.style.opacity = "0%"; 
				// hr.style.transition = "0.5s";
				// hr.style.margin = "0px"
				// hr.style.opacity = "0%"; 
				setTimeout(function(){	
					globalCardsOnScreen--;
					undoButton.outerHTML = "";
					deletedCard.outerHTML = "";
					// hr.outerHTML = "" ;
					if (globalCardsOnScreen === 0){
						addCard();
					}
				},500)
			},3500)
        }  else {
            //Something else went wrong
            $("#cards-input-error-alert").fadeIn(450);
            $("#cards-input-errors" ).html(`Something went wrong. Please try again. [Details: Exception Caught. HTTP status: ${response.status}]`);
        }
    })
    .catch(response => {

            //Something else went wrong
            $("#cards-input-error-alert").fadeIn(450);
            $("#cards-input-errors" ).html(`Something went wrong. Please try again. [Details: Exception Caught. HTTP status: ${response.status}]`);
        
    });

}

function undoDelete(cardID){
	clearTimeout(globalUndoTimer);

	globalIDsToValidate.push(cardID);
	$("#fc-edit-back-" + cardID).attr("name", "fc-edit-back-" + cardID);
	$("#fc-edit-front-" + cardID).attr("name", "fc-edit-front-" + cardID);
	$("#fc-db-id-" + cardID).attr("name", "fc-db-id-" + cardID);

	const deletedCard = document.getElementById("flashcard-id-" + cardID);
	const undoWrapper = document.getElementById("card-undo-wrapper-" + cardID);

	//Display the card to get its height and hide it immediately.
	deletedCard.style.display = "";
	deletedCardHeight = $(deletedCard).height();
	deletedCard.style.display = "none";

	//reverse of delete transition
	undoWrapper.style.height = deletedCardHeight + "px";
	$(undoWrapper).fadeOut(250);
	setTimeout(function(){
		deletedCard.style.display = "";
		deletedCard.style.opacity = "0%";
		deletedCard.style.transition = "0.25s"
		setTimeout(function(){
		deletedCard.style.opacity = "100%";
		}, 50);
	}, 250);

	

	hr = document.getElementById("hr-id-" + cardID);
	hr.style.opacity = "100%";
	hr.style.margin = "1rem 0 1rem 0"

	saveCards();
}

const transitions = {
  heightGrow : (itemToGrow, delay=500, fromZero = true, finalHeight=null) => {
    itemHeight = $(itemToGrow).height();
	if(finalHeight===null){finalHeight = itemHeight;};
	if(fromZero){
		itemToGrow.style.height = "0px";
	} else {
		itemToGrow.style.height = itemHeight + "px";
	}
	itemToGrow.style.transition = delay+"ms";
	itemToGrow.style.overflow = "hidden";
	setTimeout(function(){
		itemToGrow.style.height = finalHeight+"px";
		setTimeout(function(){
			itemToGrow.style.overflow ="";
			itemToGrow.style.height = "";
		}, (delay/2));
	}, (delay/2));
  },

  heightShrink : (itemToShrink, delay=500, finalHeight=0) => {
	itemHeight = $(itemToShrink).height();
	itemToShrink.style.height = itemHeight + "px";
	itemToShrink.style.transition = delay+"ms";
	itemToShrink.style.overflow = "hidden";
	setTimeout(function(){
		itemToShrink.style.height = finalHeight + "px";
		setTimeout(function(){
			itemToShrink.style.overflow ="";
			itemToShrink.style.display = "none";
		}, (delay/2));
	}, (delay/2));
  }
};

</script>

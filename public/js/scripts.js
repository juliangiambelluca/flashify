const openFlashcardModal = (flashcardID, startOnFront = true) => {

	if (startOnFront){
		document.getElementById("modal-card-front").innerHTML = "<h2 class='flashcard-front-text'>" + flashcards.fronts[flashcardID] + "</h2>";
		document.getElementById("modal-button-flip").onclick = () => openFlashcardModal(flashcardID, false);
	} else {
		document.getElementById("modal-card-front").innerHTML = "<h3 class='flashcard-back-text'>" + flashcards.backs[flashcardID] + "</h3>";
		document.getElementById("modal-button-flip").onclick = () => openFlashcardModal(flashcardID, true);	
	}	

	
	//If it's the first or last card, disable the previous or next buttons respectively.
	if(flashcardID !== 0){
		document.getElementById("modal-button-flip").style.display = "block";
		document.getElementById("modal-button-previous").onclick = () => openFlashcardModal(flashcardID - 1);
	} else {
		document.getElementById("modal-button-previous").style.display = "none";
	}
	if(flashcardID !== flashcards.fronts.length - 1){
		document.getElementById("modal-button-next").display = "block";
		document.getElementById("modal-button-next").onclick = () => openFlashcardModal(flashcardID + 1);
	} else {
		document.getElementById("modal-button-next").style.display = "none";
	}
	
	$('#fc-viewer-modal').modal();

}

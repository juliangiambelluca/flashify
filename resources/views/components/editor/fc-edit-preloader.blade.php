<?PHP


if(isset($flashcards)){
    initPrepCards($flashcards);
} else {
    initPrepCards();
}


function initPrepCards($flashcards=null) {
$jsPrepOutput = "let globalCardIDCounter = 0;\n";
$jsPrepOutput .= "let globalIDsToValidate = [];\n";
$htmlPrepOutput = "";
$cardsInserted = 0;
if(isset($flashcards)){
        $prepCardIDCounter = 0;

        foreach($flashcards as $flashcard){
            $currentCardID = $flashcard->id;
            $currentCardFront = $flashcard->front;
            $currentCardBack = $flashcard->back;

$cardToInsert = <<<EOD
<div class="row" id="flashcard-id-$prepCardIDCounter">
	<div class="col-md-6">
		<div class="card card-set shadow m-2 border-left-success hover-feedback-light no-active-shrink">
			<div class="card-body">
				<div class="text-right" style="margin: -12px -10px">
					<a href="#/" 
					onmouseenter="highlightDeletions(true, 'flashcard-id-$prepCardIDCounter');" 
				onmouseleave="highlightDeletions(false, 'flashcard-id-$prepCardIDCounter');" 
				onclick="deleteCard($prepCardIDCounter)"
					class="tool-tip">
						<span class="tool-tip-text">Delete card</span>
						<i class="fas fa-trash-alt  fa-fw hover-feedback-strong text-danger"></i>
					</a>
				</div>
				<textarea 
				maxlength="512" placeholder="Edit front of card" 
				class="form-control flashcard-input-front transparent-input" 
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
		<div class="card card-set shadow m-2 border-left-info hover-feedback-light no-active-shrink">
			<div class="card-body">
				<textarea 
				maxlength="512" placeholder="Edit back of card"
				class="form-control flashcard-input-back transparent-input" 
				aria-describedby="fc-edit-back-help-$prepCardIDCounter" 
				id="fc-edit-back-$prepCardIDCounter" 
				name="fc-edit-back-$prepCardIDCounter">$currentCardBack</textarea> 
				<small class="form-text text-gray-500" id="fc-edit-back-help-$prepCardIDCounter">
					Max. 512 Characters.
				</small> 
			</div>
		</div>
	</div>
	<input type="hidden" id="fc-db-id-$prepCardIDCounter" name="fc-db-id-$prepCardIDCounter" value="$currentCardID">
</div>
<hr id="hr-id-$prepCardIDCounter">
EOD;

            $htmlPrepOutput .= $cardToInsert; 
            $jsPrepOutput .= "globalIDsToValidate.push(" . $prepCardIDCounter . ");";
            
            $cardsInserted = $prepCardIDCounter;
		    $prepCardIDCounter++;
        } //end for loop

    //Times gone through loop = cards inserted.
    $jsPrepOutput .= "globalCardIDCounter = " . $prepCardIDCounter . ";";
    
     

}//End of if isset flashcards statement

    echo "<script>" . $jsPrepOutput . "</script>";
	echo $htmlPrepOutput;

}

?>
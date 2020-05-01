<!--
*********
This is the template for the back of card editor.
Many of these will be generated inside a form in the "pages.cards-editor" view within "pages.editor"

It must be passed a unique id corresponding to the back of the card.


fc-edit-back- 'This card's ID' will be posted to the server on form submit
containing the text for the back of this flashcard.
*********
-->

<div class="card card-set shadow m-2 border-left-info hover-feedback-light">
		<div class="card-body">
			<textarea 
			aria-describedby="fc-edit-back-help-${globalCardIDCounter}" 
			class="form-control transparent-input" 
			id="fc-edit-back-${globalCardIDCounter}" 
			name="fc-edit-back-${globalCardIDCounter}"
			maxlength="512" placeholder="Edit back of card" rows="7"></textarea> 
			<small class="form-text text-gray-500" id="fc-edit-back-help-${globalCardIDCounter}">Max. 512 Characters.</small> <!-- <script> $("#cardSetDescription").autogrow(); </script> -->
		</div>
</div>

<!-- <div class="card card-set shadow m-2 border-left-info hover-feedback-light">
		<div class="card-body">
			<textarea 
			maxlength="512" placeholder="Edit back of card" rows="7"
			class="form-control transparent-input" 
			aria-describedby="fc-edit-back-help-{{ $prepCardIDCounter ?? '${globalCardIDCounter}' }}" 
			id="fc-edit-back-{{ $prepCardIDCounter ?? '${globalCardIDCounter}' }}" 
			name="fc-edit-back-{{ $prepCardIDCounter ?? '${globalCardIDCounter}' }}">{{ $currentCardBack ?? '' }}</textarea> 
			<small class="form-text text-gray-500" id="fc-edit-back-help-{{ $prepCardIDCounter ?? '${globalCardIDCounter}' }}">
				Max. 512 Characters.
			</small> 
		</div>
</div> -->
<!--
*********
This is the template for the back of card editor.
Many of these will be generated inside a form in the "pages.cards-editor" view within "pages.editor"

It must be passed a unique id corresponding to the back of the card.


fc-edit-back- 'This card's ID' will be posted to the server on form submit
containing the text for the back of this flashcard.
*********
-->

<div class="card card-set flashcard-edit-back set-left-border-color set-color hover-feedback-light no-active-shrink">
		<div class="card-body">
			
		<!-- Make up for border width -->
		<div style="margin-left:-1rem">

			<div class="text-right " style="margin: -12px -10px">
					<a href="#/" 
					onmouseenter="highlightDeletions(true, 'flashcard-id-${globalCardIDCounter}');" 
					onmouseleave="highlightDeletions(false, 'flashcard-id-${globalCardIDCounter}');" 
					onclick="deleteCard(${globalCardIDCounter})" class="tool-tip">
						<span class="tool-tip-text">Delete card</span><i class="fas fa-trash-alt  hover-feedback-strong fa-fw text-danger"></i>
					</a>
				</div>
			
				<textarea 
				onfocusout="clearInputError(this);"
				aria-describedby="fc-edit-back-help-${globalCardIDCounter}" 
				class="form-control flashcard-input-back mt-2 transparent-input" 
				id="fc-edit-back-${globalCardIDCounter}" 
				name="fc-edit-back-${globalCardIDCounter}"
				maxlength="512" placeholder="Edit back of card" ></textarea> 
				<small class="form-text text-black-50" id="fc-edit-back-help-${globalCardIDCounter}">Max. 512 Characters.</small> <!-- <script> $("#cardSetDescription").autogrow(); </script> -->
			</div>
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
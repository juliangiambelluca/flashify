<!--
*********
This is the template for the front of card editor.
Many of these will be generated inside a form in the "pages.cards-editor" view within "pages.editor"

It must be passed a unique id corresponding to the back of the card.

fc-edit-front- 'This card's ID'  will be posted to the server on form submit
containing the text for the front of this flashcard.
*********
-->
<div class="card card-set shadow m-2 border-left-success hover-feedback-light">
		<div class="card-body">
			<div class="text-right " style="margin: -12px -10px">
				<a href="#/" 
				onmouseenter="highlightDeletions(true, 'flashcard-id-${globalCardIDCounter}');" 
				onmouseleave="highlightDeletions(false, 'flashcard-id-${globalCardIDCounter}');" 
				onclick="deleteCard(${globalCardIDCounter})" class="tool-tip">
					<span class="tool-tip-text">Delete card</span><i class="fas fa-trash-alt  hover-feedback-strong fa-fw text-danger"></i>
				</a>
			</div>
			
			<textarea 
				onfocus="clearInputError(this);"
				aria-describedby="fc-edit-front-help-${globalCardIDCounter}" 
				class="form-control mt-2 flashcard-input-front transparent-input" 
				id="fc-edit-front-${globalCardIDCounter}" name="fc-edit-front-${globalCardIDCounter}" 
				maxlength="512" rows="10"
				placeholder="Edit front of card" ></textarea> 
				<small class="form-text text-gray-500" id="fc-edit-front-help-${globalCardIDCounter}">Max. 512 Characters.</small>
		</div>
</div>
<!-- 
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
			aria-describedby="fc-edit-front-help-{{ $prepCardIDCounter ?? '${globalCardIDCounter}' }}" 
			id="fc-edit-front-{{ $prepCardIDCounter ?? '${globalCardIDCounter}' }}" 
			name="fc-edit-front-{{ $prepCardIDCounter ?? '${globalCardIDCounter}' }}">{{ $currentCard ?? '' }}</textarea> 
			<small class="form-text text-gray-500" id="fc-edit-front-help-{{ $prepCardIDCounter ?? '${globalCardIDCounter}' }}">
				Max. 512 Characters.
			</small>
		</div>
</div>
 -->
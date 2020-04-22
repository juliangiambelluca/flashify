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
			<div class="text-right" style="margin: -12px -10px"><a href="#" class="tool-tip"><span class="tool-tip-text">Delete card</span><i class="fas fa-trash-alt fa-sm fa-fw text-danger"></i></a></div>
				<textarea aria-describedby="fc-edit-front-help-${globalCardIDCounter}" class="form-control transparent-input" 
				id="fc-edit-front-${globalCardIDCounter}" name="fc-edit-front-${globalCardIDCounter}" maxlength="512" placeholder="Edit front of card" rows="7"></textarea> 
				<small class="form-text text-gray-500" id="fc-edit-front-help-${globalCardIDCounter}">Max. 512 Characters.</small>



			







		</div>
</div>
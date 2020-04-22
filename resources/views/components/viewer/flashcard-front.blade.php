<!--
*********
DOCUMENTATION WRONG
****
This is the template for the front of card editor.
Many of these will be generated inside a form in the "pages.cards-editor" view within "pages.editor"

It must be passed a unique id corresponding to the back of the card.

fc-edit-front- 'This card's ID'  will be posted to the server on form submit
containing the text for the front of this flashcard.
*********
-->
<a href="#" onclick="openFlashcardModal({{ $flashcardID }})">
<div class="card card-set shadow m-2 border-left-success hover-feedback-light">
		<div class="card-body">
            <h3>{{ $flashcardFront }}</h3>
		</div>
</div>
</a>
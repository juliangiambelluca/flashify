
<!--
*********
This is the template for the card set editor.
This will be loaded into a form in the "pages.set-editor" view within "pages.editor"

Here the values for the title & description of the card set are obtained from the user.

fc-card-title & fc-card-desc will be posted to the server on form submit
containing the title and description for this set.
*********
-->
<div class="card card-set shadow mb-4 border-left-primary hover-feedback-light">
	<form>
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<input autofocus class="form-control title-input transparent-input h6 m-0 font-weight-bold text-primary" maxlength="64" 
			id="fc-set-title" name="fc-set-title" placeholder="Edit Card Set Title" type="text">
		</div>
		<div class="card-body">
			<textarea aria-describedby="fc-set-desc-help" class="form-control transparent-input" 
			id="fc-set-desc" name="fc-card-desc" maxlength="256" placeholder="Edit card set description" rows="4"></textarea> 
			<small class="form-text text-gray-500" id="fc-set-desc-help">Max. 256 Characters.</small> 
		</div>
	</form>
</div>
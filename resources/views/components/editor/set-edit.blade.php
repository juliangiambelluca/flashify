
<!--
*********
This is the template for the card set editor.
This will be loaded into a form in the "pages.set-editor" view within "pages.editor"

Here the values for the title & description of the card set are obtained from the user.

fc-set-title
fc-set-desc 

will be posted to the server on form submit
containing the title and description for this set.
*********
-->
<div class="card card-set shadow set-left-border-color hover-feedback-light">

	<form>
		<div class="card-body">
			<input autofocus class="form-control transparent-input mb-2 font-weight-bold set-text-color" maxlength="64" 
			id="fc-set-title" name="fc-set-title" placeholder="Edit Card Set Title" style="/*h5 size*/font-size: 1.25rem;margin: -8px 0px 0 -10px;"type="text" value="{{ $set->title ?? '' }}">
			
			<textarea aria-describedby="fc-set-desc-help" class="form-control transparent-input" 
			id="fc-set-desc" name="fc-set-desc" maxlength="256" 
			placeholder="Edit card set description">{{ $set->description ?? ''  }}</textarea> 
			<small class="form-text text-gray-500" id="fc-set-desc-help"">Max. 256 Characters.</small> 
		</div>
	</form>

</div>

<!--
*********
This is the template for the card set options.
This will be loaded into a form in the "pages.set-editor" view within "pages.editor"

Here the we obtain the following additional settings for the card set:
set colour, category, tags & if the set should be public or not.

To obtain the selected colour, there is a button for each color.
Upon pressing a button, the javascript function "selectColor" will be executed.

selectColor will toggle an outline on the clicked colour button to show the user what colour they
have selected, and write the selected colour into a hidden textfield in RGB format.

This section will post the following data to the server upon form submit:
fc-set-color = color in rgb format (rgb(78, 115, 223))
fc-set-category = selected category as string
fc-set-tags = a string containing comma separated tags
fc-set-ispublic = boolean specifiying if this set should be publically available in search

*********
-->

<div class="card card-set shadow mb-4 border-left-info hover-feedback-light">
	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-info">
			Additional Options for this set
		</h6>
	</div>
	<div class="card-body" style="padding: 1rem">
    <div class="row m-2">
      <div class="col-12">
      	<label class="form-check-label">Set Color</label><br>
        <div style="padding: 10px 0px 0px 0px">

          <!--These are the colour buttons-->
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #4e73df"></button>
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #6610f2"></button>
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #e83e8c"></button>
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #e74a3b"></button>
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #fd7e14"></button>
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #f6c23e"></button>
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #1cc88a"></button>
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #36b9cc"></button>
          <button type="button" class="btn m-1 btn-circle btn-sm" onclick="selectColor(this)" style="background-color: #5a5c69"></button>

        </div>

        <!--The hidden text field to the which the selected colour will be written into-->
        <input type="hidden" id="fc-set-color" name="fc-set-color" value="rgb(78, 115, 223)">

      </div>
    </div>
    <div class="row m-2" style="padding-top: 10px">
			<div class="col-xl-5">
        <div class="form-group">
          <label for="fc-set-category">Category</label><br>
          
          <!-- Category selector -->
            <select class="form-control-sm" text="Select a category" id="fc-set-category" name="fc-set-category">
              <option>Select a category</option>
              <option>Science</option>
              <option>Maths</option>
              <option>Business</option>
              <option>Computer Science</option>
              <option>Art</option>
            </select>

        </div>
			</div>

			<div class="col-xl-7">					
        <div class="form-group"style="margin-bottom: 0px">
          <label for="fc-set-tags">Tags</label><br>

          <!-- Tags input. 
          data-role="tagsinput" is recognised by the tags input formatting plugin to bound each SPACE separated tag with a box  
          value returned is a string with comma separated tags.-->
          <input aria-describedby="fc-tags-help" class="form-control-xs m-0" data-role="tagsinput" name="fc-set-tags" id="fc-set-tags" type="text"> 
          <small class="form-text text-gray-500" id="fc-tags-help">Separate with SPACE</small></span>
        
        </div>
      </div>
    </div>
    <div class="row" >
			<div class="col-sm-6 ">
				<div class="form-check p-3">
					<label class="form-check-label" for="fc-set-onfeed">
            <i class="fas fa-users fa-sm"></i> Publish to my account
          </label> 

          <!--Checkbox to select if the user would like this set to be publically available via search-->
          <input class="form-check-input" id="fc-set-onfeed" name="fc-set-onfeed" aria-describedby="fc-set-onfeed-help" checked type="checkbox">

          <small class="form-text text-gray-500" id="fc-set-onfeed-help">Let your followers see this on their feed & your profile.</small>
				</div>
			</div>
      <div class="col-sm-6 ">
				<div class="form-check p-3">
					<label class="form-check-label" for="fc-set-ispublic">
            <i class="fas fa-globe fa-sm"></i> Add to community
          </label> 

          <!--Checkbox to select if the user would like this set to be publically available via search-->
          <input class="form-check-input" id="fc-set-ispublic" name="fc-set-ispublic" aria-describedby="fc-set-ispublic-help"  type="checkbox">

          <small class="form-text text-gray-500" id="fc-set-ispublic-help">Contribute to our community so that anybody can find this.</small>
				</div>
			</div>
    </div>
   
	</div>
</div>
<script>
  /* This function will toggle an outline on the clicked colour button to show the user what colour they
have selected, and write the last selected colour into a hidden textfield in RGB format. */
  function selectColor(selected)
  {
    
    //Go through all elements in this document to see which ones matches all of these classes. Only one item should be returned.
    let x = document.getElementsByClassName("btn btn-circle btn-sm color-button-checked");
    let i;
    
    /* This will loop through all the elements found and stored in x. Only one or zero elements should usually be found
    This one element would usually be the last colour BUTTON to be clicked. */
    for (i = 0; i < x.length; i++) {
      //If any elements were passed to variable x, remove the class which gives the button its outline
      x[i].classList.remove("color-button-checked");
    }

    /* Now that no elements (colour buttons; usually the last one to be clicked) contain an outline, give the
    button that called this function an outline, to show the user what colour they have selected.*/
    selected.classList.add("color-button-checked")

    //Get the colour of the selected colour button and write that value to the hidden fc-set-color text field.
    document.getElementById("fc-set-color").value = selected.style.backgroundColor;
  }
</script>
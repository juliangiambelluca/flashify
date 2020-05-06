<div class="card card-set shadow mb-4 set-left-border-color hover-feedback-light">
  <div class="left-border-color-darker">
    <div class="card-body" style="padding: 1rem">
      <h5 class="m-2 mb-4 font-weight-bold set-text-color">
        Set Options
      </h5>
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
          <input type="hidden" id="fc-set-color" name="fc-set-color" value=" {{ $set->color ?? 'rgb(78, 115, 223)' }} ">

        </div>
      </div>
      <div class="row m-2" style="padding-top: 10px">
        <div class="col-12">					
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
      <div class="row m-2" >
        <div class="col-12 ">
          <div class="form-group" style ="">

            <label for="fc-set-privacy">Privacy</label><br>
            <!-- Category selector -->
            <div class="row" width="100%">
              <div class="col-2 text-center">
              <i class="col-3 fas  fa-fw fa-lock"></i>
              </div>
              <div class="col-10" >
                <select 
                onclick="switchHelpData(this)"
                style="width:100%!important; max-width:200px"
                class=" col-9 form-control-sm"               
                text="Select a category" 
                id="fc-set-privacy" 
                name="fc-set-privacy">
                <option>Do not publish (Private)</option>
                <option selected="selected">Publish to followers</option>
                <option>Publish to community (Public)</option>
              </select>
              </div>

            </div>
            
            
            <script>
              function switchHelpData(selector){
                if(selector.value==='Publish to followers'){
                $('#privacy_help').html('Let your followers see this on their feed & your profile.');
                } else if (selector.value==='Publish to community (Public)'){
                $('#privacy_help').html('Contribute to our community so that anybody can find this.');
                } else {
                $('#privacy_help').html("");
                }
              }  
            </script> 

            <p id="privacy_help" class="m-2 mt-3">
              Let your followers see this on their feed & your profile.
            </p>

          </div>

        </div>

      </div>
    </div>
	</div>
</div>
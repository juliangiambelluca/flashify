  <!-- Flashcard Viewer Modal-->
  <div class="modal fade" id="fc-viewer-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="modal-card-text">

          <!-- Flashcard text gets inserted in here by JS -->
          
          </div>
        </div>
        <div class="modal-footer">
          <div class="row m-4">
            <div class="col-4" style="text-align: right">
		          <a class="btn btn-secondary btn-circle" style="margin-top: 9px" id="modal-button-previous" href="#" onclick=""><i class="fas fa-chevron-left align-middle" style="margin-left: -3px"></i></a>
            </div>
            <div class="col-4" style="text-align: center">
              
              <a class="btn btn-circle btn-lg btn-primary hover-feedback tool-tip"  href="#" id="modal-button-flip" onclick="" type="button"><span class="tool-tip-text">Flip</span><i class="fas fa-sync-alt align-middle"></i></a>

            </div>
            <div class="col-4" style="text-align: left">
              <a class="btn btn-secondary btn-circle" style="margin-top: 9px" id="modal-button-next" href="#" onclick=""><i class="fas fa-chevron-right align-middle" style="margin-right: -3px"></i></a></div>
            </div>
        </div>
      </div>
    </div>
  </div>
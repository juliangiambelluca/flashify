@extends('layouts.dash')
@section('page-title') 
Study - Flashify 
@endsection 
@section('content') <!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-2">
	<div class="col-lg-8">
		<h1 class="h1 text-gray-800">
            {{ $flashcards["title"] }}
		</h1><br>
	</div>
	<div class="col-lg-4">
		<a class="hover-feedback" href="{{ route('pages.set-editor') }}">
		<div class="card header-card-button border-left-primary shadow py-2">
			<div class="card-body" style="padding: 0.5rem">
				<div class="row no-gutters align-items-center">
					<div class="col-2" style="text-align: center">
						<i class="fas fa-pencil-alt text-primary" style="transform: scale(1.3)"></i>
					</div>
					<div class="col-10">
						<div class="h5 mb-0 font-weight-bold text-primary">
							Edit Set
						</div>
					</div>
				</div>
			</div>
		</div></a>
    </div>
</div>

<div class="row m-1">
    <div class="col-12">
        <p>{{ $flashcards["description"] }}</p>
    </div>
</div>

<div class="row">
	<div class="col-12">
		<div class="packery-grid">
      @for ($cardsIterator = 0; $cardsIterator < count($flashcards["flashcardFronts"]); $cardsIterator++) 
        @php 
          $flashcardFront = $flashcards["flashcardFronts"][$cardsIterator]; 
          $flashcardBack = $flashcards["flashcardBacks"][$cardsIterator]; 
		@endphp
			<a href="#" class="text-gray-900">
		  	<div class="packery-grid-item-3">
				@include('components.viewer.flashcard-front')
			</div>
			</a>
      @endfor
		</div>
	</div>
</div>
<div class="row">
	<br>
</div>
<script>
$('.packery-grid').packery({
  itemSelector: '.packery-grid-item-3',
  gutter: 10
});
</script> 






        
  <!-- Flashcard Viewer Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>














@endsection
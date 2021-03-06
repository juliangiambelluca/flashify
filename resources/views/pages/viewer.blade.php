@extends('layouts.dash')
@section('page-title') 
Study - Flashify 
@endsection 
@section('content') 
<style id="set-color-styles">
<?php
$setColor = $set->color ?? "#4e73df";

$stylesToInsert = <<<EOD
    .set-left-border-color{
        border-left: 0.5rem solid $setColor !important;
        transition: 0.5s
    }
    .set-text-color, .set-text-color i{
        color: $setColor!important;
        transition: 0.5s
    }
    .set-color.flashcard-edit-front, .set-color.btn, .set-color.left-sidenav{
        background-color: $setColor !important;
        transition: 0.5s
    }
EOD;

echo $stylesToInsert;
?>

</style>
<div class="row d-sm-flex align-items-center justify-content-between mb-2">
	<div class="col-lg-8">
		<h1 class="h1 text-gray-800">
            {{ $set->title }}
		</h1><br>
	</div>
	<div class="col-lg-4">
		<a href="{{ route('pages.set-editor') }}">
		<div class="card hover-feedback header-card-button border-left-primary shadow py-2">
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
        <p>{{ $set->description }}</p>
    </div>
</div>

<div class="row">
	<div class="col-12">
		<div class="packery-grid">
		@php 
		$fcIterator = 0
		@endphp
		@foreach($flashcards as $flashcard)
		@php
          $flashcardFront = $flashcard->front; 
          $flashcardBack = $flashcard->back; 
		  $flashcardID = $fcIterator;
		  $fcIterator++;
		@endphp
			<a href="#" class="text-gray-900">
		  	<div class="packery-grid-item-3">
				@include('components.viewer.flashcard-front')
			</div>
			</a>
     	@endforeach
		</div>
	</div>
</div>
<div class="row">
	<br>
</div>

<!-- Include the flashcard modal to reduce clutter -->
@include('components.viewer.flashcard-modal')

<!-- Innitiate the packery plugin -->
<script>
$('.packery-grid').packery({
  itemSelector: '.packery-grid-item-3',
  gutter: 10
});
</script> 


<script>
	//Populate javascript array with PHP array values passed from model.
	//Values are sanitised before being evaluated by javascript this way, ensuring security against XSS
	//Not as elgant or efficient as imploding the PHP array, but it's more secure.
	// Global flashcards array
	const flashcards = {
		fronts: [
			@foreach($flashcards as $flashcard)
				'{{ $flashcard->front }}',
			@endforeach
		],
		backs: [
			@foreach($flashcards as $flashcard)
			'{{ $flashcard->back }}',
			@endforeach
		]
	};
	
	// Global variables to be accessed by arrow key pressed events
	let currentFlashcardID = 0;
	let currentFlashcardSide = false;

	const openFlashcardModal = (flashcardID, startOnFront = true) => {

		// Card flipping code.
		// if second argument passed is false, display back of flashcard first.
		// this is so that when you click on a flash card front it doesn't show you the front again.
		if (startOnFront){
			document.getElementById("modal-card-text").innerHTML = "<h2 class='flashcard-front-text'>" + flashcards.fronts[flashcardID] + "</h2>";
			document.getElementById("modal-button-flip").onclick = () => openFlashcardModal(flashcardID, false);
			currentFlashcardSide = true;
		} else {
			document.getElementById("modal-card-text").innerHTML = "<h3 class='flashcard-back-text'>" + flashcards.backs[flashcardID] + "</h3>";
			document.getElementById("modal-button-flip").onclick = () => openFlashcardModal(flashcardID, true);	
			currentFlashcardSide = false;
		}	

		//If it's the first or last card, disable the previous or next buttons respectively.
		if(flashcardID !== 0){
			document.getElementById("modal-button-previous").style.display = "inline-block";
			document.getElementById("modal-button-previous").onclick = () => openFlashcardModal(flashcardID - 1);
		} else {
			document.getElementById("modal-button-previous").style.display = "none";
		}
		if(flashcardID !== flashcards.fronts.length - 1){
			document.getElementById("modal-button-next").style.display = "inline-block";
			document.getElementById("modal-button-next").onclick = () => openFlashcardModal(flashcardID + 1);
		} else {
			document.getElementById("modal-button-next").style.display = "none";
		}
		
		$('#fc-viewer-modal').modal();

		currentFlashcardID = flashcardID;

	}

	document.onkeydown = function(evt) {
    evt = evt || window.event;
    switch (evt.keyCode) {
        case 37:
			(() => {
				if(currentFlashcardID !== 0){
					openFlashcardModal(currentFlashcardID - 1);
				}
			})()
            break;
        case 39:
			(() => {
				if(currentFlashcardID !== flashcards.fronts.length - 1){
					 openFlashcardModal(currentFlashcardID + 1);
				} 
			})()			
            break;
			case 38:
		case 40:
			(() => {
				if(currentFlashcardSide === true){
					openFlashcardModal(currentFlashcardID, false);
				} else {
					openFlashcardModal(currentFlashcardID, true);
				}
			})()
            break;
    }
};

</script>



      














@endsection
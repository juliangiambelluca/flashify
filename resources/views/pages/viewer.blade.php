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
          $flashcardID = $cardsIterator; 
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
		//Populate javascript array with PHP array values passed from controller.
		//Values are sanitised before being evaluated by javascript this way, ensuring security against XSS
		//Not as elgant or efficient as imploding the PHP array, but it's more secure.
		const flashcards = {
			fronts: [ 
				@for ($i = 0; $i < count($flashcards["flashcardFronts"]); $i++)
				{!! "'" !!}{{ $flashcards["flashcardFronts"][$i] }}{!! "', " !!}
				@endfor
				],
			backs: [ 
				@for ($i = 0; $i < count($flashcards["flashcardBacks"]); $i++)
				{!! "'" !!}{{ $flashcards["flashcardBacks"][$i] }}{!! "', " !!}
				@endfor
			]
		};

const openFlashcardModal = (flashcardID) => {

	
	document.getElementById("modal-card-front").innerHTML = flashcards.backs[flashcardID];
	
	if(flashcardID !== 0){
		document.getElementById("modal-button-previous").display = "block";
		document.getElementById("modal-button-previous").onclick = () => openFlashcardModal(flashcardID - 1);
	} else {
		document.getElementById("modal-button-previous").display = "none";
	}
	if(flashcardID !== flashcards.fronts.length - 1){
		document.getElementById("modal-button-next").display = "block";
		document.getElementById("modal-button-next").onclick = () => openFlashcardModal(flashcardID + 1);
	} else {
		document.getElementById("modal-button-next").display = "none";
	}
	
	
	document.getElementById("modal-card-front").innerHTML = flashcards.backs[flashcardID];



	$('#fc-viewer-modal').modal()


}

</script>



      














@endsection
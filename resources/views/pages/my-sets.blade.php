@extends('layouts.dash')
@section('page-title') 
My Sets - Flashify 
@endsection 
@section('content')

<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-8">
		<h1 class="h1 text-gray-800">
			My Card Sets.
		</h1><br>
	</div>
	<div class="col-lg-4">
		<a href="{{ route('pages.editor') }}">
		<div class="card header-card-button hover-feedback set-left-border-color shadow py-2">
			<div class="card-body set-text-color" style="padding: 0.5rem">
				<div class="row no-gutters align-items-center">
					<div class="col-2" style="text-align: center">
						<i class="fas fa-plus-circle" style="transform: scale(1.3)"></i>
					</div>
					<div class="col-10">
						<div class="h5 mb-0 font-weight-bold">
							Create A New Card Set
						</div>
					</div>
				</div>
			</div>
		</div></a>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="packery-grid">
			@foreach($sets as $set)
			@php
				$miniFlashcards = $set->flashcards()->take(4)->get();
				$cardID = $set->id;
				$cardTitle = $set->title; 
				$cardDesc = $set->description; 
				$cardTags = "Tag 1, Tag 2, Tag 3";

			@endphp
			<div class="packery-grid-item p-2">
			@include('components.viewer.flashcard-set')
       		 </div>
    		@endforeach


    
		</div>
	</div>
</div>
<div class="row">
	<br>
</div>

<div class="row">
	<div class="col-12">
		<div class="sets-pagination">
		
		{{ $sets->links() }}
		</div>
	</div>
</div>

<script>
$('.packery-grid').packery({
  itemSelector: '.packery-grid-item',
  gutter: 10
});
</script> 
@endsection
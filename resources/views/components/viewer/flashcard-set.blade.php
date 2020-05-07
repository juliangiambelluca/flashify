<!--
***********

This is the template for displaying a card set.

Before including this file, you must declare the following variables
for this template to access:

  $ cardTitle (string)
  $ cardDesc (string)
  $ cardID (integer)
  $ cardTags (string)

***********
-->
<div class="card card-set shadow set-left-border-color hover-feedback-light" style="border-color: {{ $set->color ?? '' }} ">

		<div class="card-body">
		<div class="row">
			<div class="col-11">
			<h5 class="mb-3 font-weight-bold" style="color: {{ $set->color ?? '' }}">
       			{{ $cardTitle }}
      		</h5>
			</div>
			<div class="col-1">
			<div class="dropdown no-arrow">
			<a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropdownMenuLink" role="button"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
			<div aria-labelledby="dropdownMenuLink" class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
				<div class="dropdown-header">
					Card Set Options
				</div><a class="dropdown-item" href="#">Edit</a> <a class="dropdown-item" href="#">Save to My Sets</a>
				<div class="dropdown-divider"></div><a class="dropdown-item" href="#">Delete</a>
			</div>
		</div>
			</div>
		</div>
		

		<div class="row mini-card-gradient">
		@foreach($miniFlashcards as $miniFlashcard)
      	  @php 
         	 $miniCardText = $miniFlashcard->front; 
       	  @endphp 
        @include('components.viewer.flashcard-mini') 
    	@endforeach
		   </div>
		   
<div class="m-2 mt-0">

{{ $cardDesc }}

</div>
 	   

			
			  <div class="row card-set-bottom-actions mt-3">
			<div class="col-8">
				<span class="small text-gray-500">Tags: {{ $cardTags }}<br>
				Created by You 15 Hours ago.</span>
			</div>
			<div class="col-4" style="text-align: right">
				<a class="btn btn-outline-secondary" href="{{ route('pages.viewer', ['id' => $cardID ]) }}" style="margin-top: 5px; font-weight:600;">VIEW DECK</a>
			</div>
		</div>
		</div>


</div>



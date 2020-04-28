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
<div class="card card-set shadow m-1 mb-2 border-left-primary hover-feedback-light">
	<!-- Card Header - Dropdown -->
	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary">
			{{ $cardTitle }}
		</h6>
		<div class="dropdown no-arrow">
			<a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropdownMenuLink" role="button"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
			<div aria-labelledby="dropdownMenuLink" class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
				<div class="dropdown-header">
					Card Set Options
				</div><a class="dropdown-item" href="#">Edit</a> <a class="dropdown-item" href="#">Save to My Sets</a>
				<div class="dropdown-divider"></div><a class="dropdown-item" href="#">Delete</a>
			</div>
		</div>
	</div><!-- Card Body -->
	<div class="card-body" style="padding: 1rem">
		<!-- Content Row -->
		<div class="row mini-card-gradient">
		@for ($miniCardsIterator = 0; $miniCardsIterator < 4; $miniCardsIterator++) 
        @php 
          $miniCardText = $sets["miniCards"][$setsIterator][$miniCardsIterator]; 
        @endphp 
        @include('components.viewer.flashcard-mini') 
      @endfor 
    </div>
    {{ $cardDesc }}
		<div class="row card-set-bottom-actions">
			<div class="col-8">
				<span class="small text-gray-500">Tags: {{ $cardTags }}<br>
				Created by You 15 Hours ago.</span>
			</div>
			<div class="col-4" style="text-align: right">
				<a class="btn btn-outline-primary" href="{{ route('pages.viewer', ['id' => $cardID ]) }}" style="margin-top: 5px;">View Set</a>
			</div>
		</div>
	</div>
</div>
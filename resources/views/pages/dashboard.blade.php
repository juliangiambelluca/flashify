@extends('layouts.dash')

@section('page-title')
Dashboard - Flashify
@endsection


@section('content')

<div class="row d-sm-flex align-items-center justify-content-between mb-4">

		<div class="col-lg-8">
      <h1 class="h1 text-gray-800">Welcome back, Julian.</h1>
      <br>
		</div>

		<div class="col-lg-4">
    <a href="{{ route('pages.editor') }}">
                <div class="card header-card-button hover-feedback border-left-success shadow py-2">
                    <div class="card-body" style="padding: 0.5rem">
                    <div class="row no-gutters align-items-center">
                    <div class="col-2" style="text-align: center">
                        <i class="fas fa-plus-circle text-success" style="transform: scale(1.3)"></i>
                        </div>
                        <div class="col-10">
                        <div class="h5 mb-0 font-weight-bold text-success">Create A New Card Set</div>
                        </div>

                    </div>
                    </div>
                </div>
                </a>
		</div>
	
</div>







          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              
            <h1 class="h3 mb-0 text-gray-800">Recents</h1>
          </div>


<hr>



<div class="row">
           <div class="col-12">
            <div class="packery-grid">
            
              @for ($setsIterator = 0; $setsIterator < count($sets["ids"]); $setsIterator++)
                      @php 
                          $cardTitle = $sets["titles"][$setsIterator]; 
                          $cardDesc = $sets["descriptions"][$setsIterator]; 
                          $cardID = $sets["ids"][$setsIterator];
		                      $cardTags = implode($sets["tags"][$setsIterator] ,", ");
                      @endphp
                      <div class="packery-grid-item">
                      @include('components.viewer.flashcard-set')               
                      </div>

              @endfor
              </div>
              </div>                    
          </div>

        <div class="row"><br></div>


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
              
              <h1 class="h3 mb-0 text-gray-800">Community Highlights</h1>
              
            </div>


            <hr>

    <div class="row">

            <div class="col-md-6">
            </div>       
            <div class="col-md-6">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
            </div>       
            <div class="col-md-6">
            </div>
        </div>
<div class="row"><br></div>

<script>
$('.packery-grid').packery({
  itemSelector: '.packery-grid-item',
  gutter: 10
});
</script> 
@endsection
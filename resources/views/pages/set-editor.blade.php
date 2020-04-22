@extends('layouts.dash') 
@section('page-title')
Flashcard Editor - Flashify
@endsection

@section('content') <!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-12">
	<h1 class="h1 text-gray-800">Create a new set.</h1>
	</div></div>
<div class="row">
	<br>
</div><!-- Content Row -->
<div class="row">
	<div class="col-md-6">
		@include('components.editor.set-edit')
	</div>
	<div class="col-md-6">
                @include('components.editor.set-options') 
                
                <a class="hover-feedback" href="{{ route('pages.cards-editor') }}">
		<div class="card border-left-success shadow py-2">
			<div class="card-body" style="padding: 0.5rem">
				<div class="row no-gutters align-items-center">
					<div class="col-2" style="text-align: center">
						<i class="fas fa-arrow-right text-success" style="transform: scale(1.3)"></i>
					</div>
					<div class="col-10">
						<div class="h5 mb-0 font-weight-bold text-success">
							Save & Continue
						</div>
					</div>
				</div>
			</div>
		</div></a>
	</div>
</div>
<div class="row">
	<br>
</div><!-- /.container-fluid -->
<!-- End of Main Content -->
@endsection
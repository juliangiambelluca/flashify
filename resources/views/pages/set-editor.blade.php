@extends('layouts.dash') 
@section('page-title')
Flashcard Editor - Flashify
@endsection

@section('content')
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-12">
	<h1 class="h1 text-gray-800">Create a new set.</h1>
	</div></div>
	@if(count($errors->all()))
<div class="row">
	<div class="col-md-6">
		<div class="alert border-left-danger alert-danger alert-dismissible fade show" role="alert">
			<strong>Oops!</strong><br>
			@foreach($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
	</div>
</div>
@endif
<div class="row">
	<br>
</div>
<form id="create-set-form" action="{{ route('potato.me') }}" method="POST">
<div class="row">
		<div class="col-md-6">
			@include('components.editor.set-edit')
		</div>
		<div class="col-md-6">
			@include('components.editor.set-options') 
			<!-- 
			Form input names created by the two includes above.
			fc-set-title
			fc-set-desc  
			fc-set-color = color in rgb format (rgb(78, 115, 223))
			fc-set-category = selected category as string
			fc-set-tags = a string containing comma separated tags
			fc-set-ispublic = boolean specifiying if this set should be publically available in search
			-->
			{{ csrf_field() }}
			<a onclick="document.getElementById('create-set-form').submit();" href="#">
				<div class="card border-left-success shadow hover-feedback py-2">
					<div class="card-body" style="padding: 0.5rem">
						<div class="row no-gutters align-items-center">
							<div class="col-2 arrow-effect-right" style="text-align: center">
								<i class="fas fa-arrow-right text-success" style="transform: scale(1.3)"></i>
							</div>
							<div class="col-10">
								<div class="h5 mb-0 font-weight-bold text-success">
									Save & Continue
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>

</div>
</form>
<div class="row">
	<br>
</div><!-- /.container-fluid -->
<!-- End of Main Content -->
@endsection
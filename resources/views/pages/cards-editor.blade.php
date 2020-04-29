
<div class="row d-sm-flex align-items-center justify-content-between mb-4">

		<div class="col-lg-6">
			<h1 class="h1 text-gray-800">
		
			the title innit
			
			</h1>
		</div>
		<div class="col-md-2">
			<a class="hover-feedback" href="#" onclick="showSetEditor()">
				<div class="card-body" style="padding: 1.2rem 0.5rem 1rem 0.5rem">
					<div class="row no-gutters align-items-center">
						<div class="col-2" style="text-align: center">
							<i class="fas fa-arrow-left text-secondary" style="transform: scale(1.3)"></i>
						</div>
						<div class="col-10">
							<div class="h5 mb-0 font-weight-bold text-secondary">
								Edit Card Set
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4">
			<a href="#">
			<div class="card border-left-primary hover-feedback shadow py-2">
				<div class="card-body" style="padding: 0.5rem">
					<div class="row no-gutters align-items-center">
						<div class="col-2" style="text-align: center">
							<i class="fas fa-save text-primary" style="transform: scale(1.3)"></i>
						</div>
						<div class="col-10">
							<div class="h5 mb-0 font-weight-bold text-primary">
								Save & View Card Set
							</div>
						</div>
					</div>
				</div>
			</div></a>
		</div>
	
</div>



<div class="row">
	<br>
	</div>





<div class="row" onload="addCard()" >
<div class="col-12" id="newCardsArea">

<!-- Javascript to generate cards into here -->



</div>

</div>

<script>

let globalCardIDCounter = 0;

//Add one card on document load
addCard();

function addCard (){

	const newCard = `
			<div class="col-md-6">
				@include('components.editor.fc-edit-front')
			</div>
			<div class="col-md-6">
				@include('components.editor.fc-edit-back')
			</div>
				`;

let z = document.createElement('div');
z.innerHTML = newCard;
z.classList = "row"
z.id = "flashcard-id-" + globalCardIDCounter;
document.getElementById('newCardsArea').appendChild(z);

let hr = document.createElement('hr');
document.getElementById('newCardsArea').appendChild(hr);

globalCardIDCounter++;

$('html, body').animate({
scrollTop: $("#" + z.id).offset().top
},800);


}

</script>


         
              
           












<div class="row">
	<div class="col-12 text-center">
		
		<button class="btn btn-circle btn-lg btn-success hover-feedback m-5 tool-tip" onclick="addCard()" type="button"><span class="tool-tip-text">Add card</span><i class="fas fa-plus fa-sm"></i></button>
		<br><br>
	</div>
</div>
<div class="row">
	<br>
</div><!-- /.container-fluid -->
<!-- End of Main Content -->

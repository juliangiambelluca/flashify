<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-12">
	<h1 class="h1 text-gray-800" id="set-title-set">
        @if(isset($set->title))
            Edit:
            {{ $set->title }}
        @else
            Create a new set
        @endif
    </h1>
	</div></div>



	<!-- Wrong inputs alert to be displayed by javascript -->
	<div id="input-error-alert" class="row" style="display:none">
		<div class="col-md-6">
			<div class="alert border-left-danger alert-danger fade show" role="alert">
				<strong>Oops!</strong><br>
				<span id="input-errors"></span>
			</button>
			</div>
		</div>
	</div>

<div class="row">
	<br>
</div>
<form id="create-set-form" action="{{ route('create.set') }}" method="POST">
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
			<input type="hidden" id="fc-set-id" name="fc-set-id" value="{{ $set->id ?? '' }}">

			<div class="row">
			<div class="col-lg-9 col-xl-6">
			<a onclick="createSet()" href="#">
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
		</div>

</div>
</form>
<div class="row">
	<br>
</div>


<script>


function createSet(){
    
    //Get Inputs
    let setInputs = {};
    //Put all inputs into object
    $.each($('#create-set-form').serializeArray(), function(i, field) {
        setInputs[field.name] = field.value;
    });
    
    //Send to server
    const sendPackage= () => {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '{{ route('create.set') }}',
                type: 'POST',
                dataType: "text",
                data: setInputs,
                success: function (response) {
                    resolve(response);
                },
                error: function (response) {
                    reject(response);
                },
            });
         });
    }


    sendPackage().then(response => {

        //Successful response looks like "success,123" where 123 is the current ID
        //It was much simpler to do this way than to receive an array from server.

        //Split response into success & ID
        let responseArray = response.split(",");

        if(responseArray[0]==="success"){
            
            //The inputs were correct & the data saved to the database  
            //Set current card's ID to enable updating db instead of insert
            document.getElementById("fc-set-id").value = responseArray[1];
            $( "#set-title-set" ).html("Edit: " + responseArray[2]);
            $( "#set-title-cards" ).html(responseArray[2]);
            
			showCardsEditor();

        } else {
            //Unexpected response from server
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html("Something went wrong. Please try again. [Details: Unexpected response from server]");

        }
    })
    .catch(response => {
        //If data validation fails, Laravel responds with status code 422 & Error messages in JSON.
        if(response.status===422) {
            let errorMsgsObj = JSON.parse(response.responseText);
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html("");

            //Extract each error message and append to alert
            for (const property in errorMsgsObj) {
                $( "#input-errors" ).append( errorMsgsObj[property] + "<br>");
            }
        } else {
            //Something else went wrong
            $("#input-error-alert").fadeIn(450);
            $( "#input-errors" ).html(`Something went wrong. Please try again. [Details: Exception Caught. HTTP status: ${response.status}]`);
        }
    });
}


</script>

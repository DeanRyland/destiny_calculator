$(document).ready(function () {

	var data;
	var loginData

	$('#gamerTag').hide();

	//Destiny Light Level Form
	//When the submit button is clicked, prevent default and serialize the $_POST
	$('#destinyLevel').on("submit", function(event) {

		window.scroll(0,0)

		event.preventDefault();

		console.log( $(this).serialize() );
		
		$.ajax({
		 	method: "POST",
		  	url: "action.php",
		  	data: $(this).serialize()
		})
		.done(function( msg ) {
		  	//alert( "Data Saved: " + msg );
		  	data = JSON.parse(msg);
		  	updateScreen();
		  	outputErrors();
		});
	});

	//Destiny Account Login Form
	//When the submit button is clicked, prevent default and serialize the $_POST
	$('#destinyLogin').on("submit", function(event) {

		event.preventDefault();

		console.log( $(this).serialize() );
		
		$.ajax({
		 	method: "POST",
		  	url: "login.php",
		  	data: $(this).serialize(),
		  	dataType: 'json'
		})
		.done(function( data ) {
		  	//alert( "Data Saved: " + msg );
		  	//parseData = $.parseJSON(msg);
		  	//console.log(data);
		  	
		  	//TURN BACK ON!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		  	updateLogin(data);
		});
	});

	//Destiny Light Level Form
	//Update the screen with the calculated Light Level
	function updateScreen(){

		//Update screen if light level has been calculated
		if(data.hasOwnProperty("light_level")){
			$('#outputLevel').show();
			$('#outputLevel #lightLevelValue h3').html(data.light_level);
			$('#outputLevel').click(function(){
				$('#outputLevel').hide();
			});
		}

		//Display error message if there are errors in the "error" array
		if(data.errors.length > 0) {
			$('.errorText').show();
			$('.errorText').html('Please enter a light level');
		}
		else {
			$('.errorText').hide();
		}

		//Display error message if there are errors in the "charLimit" array
		if(data.charLimit.length > 0) {
			$('.charText').show();
			$('.charText').html('Please only enter 3 characters');
		}
		else {
			$('.charText').hide();
		}
		//Display error message if there are errors in the "numChar" array
		if(data.numChar.length > 0) {
			$('.numText').show();
			$('.numText').html('Please only enter numeric values');
		}
		else {
			$('.numText').hide();
		}
		//Display error message if there are errors in the "negVal" array
		if(data.negVal.length > 0) {
			$('.negText').show();
			$('.negText').html('Please enter value between 0 and 999');
		}
		else {
			$('.negText').hide();
		}
	}

	
	//Destiny Light Level Form
	// Clear Button
	$('.formClear').click(function() {
		$('#destinyLevel')[0].reset();
	})


	//Destiny Light Level Form
	//Displaying errors on HTML Form
	function outputErrors() {

		$('input').removeClass('error');
		$('input').removeClass('charError');

		for (i = 0; i < data.errors.length; i++) {
			$('input[name=' + data.errors[i] + ']').addClass('error');
		}

		for (i = 0; i < data.charLimit.length; i++) {
			$('input[name=' + data.charLimit[i] + ']').addClass('charError');
		}

		for (i = 0; i < data.numChar.length; i++) {
			$('input[name=' + data.numChar[i] + ']').addClass('numError');
		}

		for (i = 0; i < data.negVal.length; i++) {
			$('input[name=' + data.negVal[i] + ']').addClass('negError');
		}
	}

	function updateLogin(data) {
		$('#destinyLogin').hide();
		$('#gamerTag').show();

		//load our character.html partial
		$.ajax({
		  	url: "partials/character.html",

		})
		.done(function( partialHtml ) {
		  	//alert( "Data Saved: " + msg );
		  	//loginData = JSON.parse(msg);

		  	//console.log(data['items']);

		  	var platformType = data['platformType'];
		  	$('#platformIcon').append('<img src="images/' + platformType + '.png" />');

		  	var gamerTag = data['gamerTag'];
		  	$('#gamerTagName').append(gamerTag);

		  	if(platformType == 'psn') {
		  		$('#gamerTag').css('background', '#000');
		  	}
		  	else{
		  		$('#gamerTag').css('background', '#107C10');
		  	}

		  	//for each character
	  		data['characters'].forEach(function logArrayElements(characterArr, index, array) {
				//console.log(characterArr['character']);
				//populate the html partial
				var characterHtml = partialHtml;

				console.log(data["items"]);

				characterHtml = characterHtml
					.replace('{{emblem}}', characterArr['charEmblem'])
					.replace('{{class}}', characterArr['charClass'])
					.replace('{{charBg}}', characterArr['charBg'])
					.replace('{{lightLevel}}', characterArr['charlightLevel'])
					.replace('{{charLevel}}', characterArr['charLevel']);
				$("#charWrapper").append(characterHtml);
	  			//append it to the chracter wrapper

			});	
		});
	}
});

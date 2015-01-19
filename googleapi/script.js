var urlApi = "https://maps.googleapis.com/maps/api/geocode";
var key = "AIzaSyCsHjgty3yMn9uLFdMpOpFSLI1QhBWBPmc";
var ajaxRequest;

$(document).ready(function() {
	$("#userAddress").on("keyup", function(e) {

		var address = $("#userAddress").val();
		if (address.length < 3) return;
		console.log("Requested address : " + address);

		$("#loader").show();
		console.log(ajaxRequest);

		ajaxRequest = $.ajax({
			url: urlApi + "/json?address=" + address + "&key=" + key
		}).done(function(result) {
			if (result.status === "INVALID_REQUEST") return;

			var results = result.results;
			console.log(results.length);
			if (results.length > 0) {


				$("#resultsList").empty();
				
				var display = $("#resultsList").css("display");



				


				for (var resultIndex in results) {
					var li = $("<li>" + results[resultIndex].formatted_address + "</li>");
					// console.log(results[resultIndex]);
					$("#resultsList").append(li);
				}

				if (display == "none") $("#resultsList").show("slide", {direction: "up"});

			}
		}).fail(function(result) {
			console.log("ERREUR");
		}).always(function () {
			// console.log("fin du traitement AJAX");
			setTimeout(function() {
				$("#loader").hide();	
			}, 500);
		});
	});


	$(document).on("click", "#resultsList li", function() {
		$("#userAddress").val($(this)[0].innerText);
		$("#resultsList").hide("slide", {
			direction: "up",
			complete: function() {
				$("#resultsList").empty();
			}
		});	
		
	});
});
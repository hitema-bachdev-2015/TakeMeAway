$(document).ready(function(){

	$( "#tabs" ).tabs({
		active:0,
	});
	// $(".lien_voiture").on('click', function(event){
	// 	event.preventDefault();
	//     $( "#tabs" ).tabs({
	//       active:0,
	//     });
	// });
	
	$(".modification").fadeIn(500).delay(3000).fadeOut(500);

	$("#valid_modif").on('click',function(e){
		e.preventDefault();
		if($(this).text()=="Modification")
		{
			$.ajax({
				url: "ajax/modifier_vehicule.php",
				type: "POST",
				data: {
					id: $("#detail_vehicule").attr("data-idVehic"),
					marque: $("#champ_constructeur").val(),
					modele: $("#champ_modele").val(),
					conso: $("#champ_consommation").val(),
					type_moteur: ($("#champ_essence").is(':checked')) ? 0 : 1,
					type_vehicule: $("#champ_vehicule").val()
				},
				success: function(data){
					// document.location.reload();
					document.location.href='index.php?modification';
				},
				error: function(){}
			});
		}
		else
		{
		
			$.ajax({
				url: "ajax/ajouter_vehicule.php",
				type: "POST",
				data: {
					marque: $("#champ_constructeur").val(),
					modele: $("#champ_modele").val(),
					conso: $("#champ_consommation").val(),
					type_moteur: ($("#champ_essence").is(':checked')) ? 0 : 1,
					type_vehicule: $("#champ_vehicule").val()
				},
				success: function(data){
					// document.location.reload();
					//console.log(data);
					if(data!=0)
					{
						document.location.href='index.php?ajout';
					}
				},
				error: function(){}
			});
		
		}
		
	});
});
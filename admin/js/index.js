$(document).ready(function(){

	$( "#tabs" ).tabs({
		active:1,
	});
	

	$("#valid_modif").on('click',function(e){
		e.preventDefault();
		$.ajax({
				url: "ajax/modifier_vehicule.php",
				type: "POST",
				data: {
					id: 1,
					marque: $("#champ_constructeur").val(),
					modele: $("#champ_modele").val(),
					conso: $("#champ_consommation").val(),
					type_moteur: ($("#champ_essence").is(':checked')) ? 0 : 1,
					type_vehicule: $("#champ_vehicule").val()
				},
				success: function(data){
				},
				error: function(){}
			});
	});
});
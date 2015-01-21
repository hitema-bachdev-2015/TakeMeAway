$(document).ready(function() {
	$("#choix_vehicule").change(function(e){
		$("#detail_vehicule").css('display', 'block');

		if($("#choix_vehicule").val() != "ajout"){
			$.ajax({
				url: "affichage_form.php",
				type: "POST",
				data: { id: $("#choix_vehicule").val() },
				dataType: 'json',
				success: function(data){
					$("#champ_constructeur").val("" + data.marque + "");
					$("#champ_modele").val("" + data.modele + "");
					(data.type_moteur == 1) ? $("#champ_essence").attr('checked','checked') : $("#champ_diesel").attr('checked','checked');
					$("#champ_consommation").val("" + data.consommation + "");
				},
				error: function(){}
			});
		}
		else {
			$("#champ_constructeur").val("");
			$("#champ_modele").val("");
			$("#champ_consommation").val("");
		}
		if($("#choix_vehicule").val() == "choix") $("#detail_vehicule").css('display', 'none');
	});


	$("#valid_modif").on('click',function(e){
		e.preventDefault();
		$.ajax({
				url: "modifier_vehicule_requeteAjax.php",
				type: "POST",
				data: {
					id: $("#choix_vehicule").val(),
					marque: $("#champ_constructeur").val(),
					modele: $("#champ_modele").val(),
					conso: $("#champ_consommation").val(),
					type_moteur: ($("#champ_essence").is(':checked')) ? 0 : 1
				},
				success: function(data){
				},
				error: function(){}
			});
	});
});
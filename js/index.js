// Mes variables
var urlApi, key;
var map;
var coutEss=1.352;
var coutDies=1.097;
//Initialisation de l'api google map
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

var markers=[];

// Apres le chargement du document
$(document).ready(function(){
	$(".notification").fadeIn(500).delay(5000).fadeOut(500);
	initialize();
	key="AIzaSyAA1ZHpUjDiK0ScA1SYZ7GIV8kDKe9HZtc";
	urlApi="https://maps.googleapis.com/maps/api/geocode";
	var adressInput1=$("#StartAddress");
	var adressInput2=$("#EndAddress");
	var buttonGeo=$("#btnGeocode");
	var btnAddFav=$("#btnAddToFavoris");
	var autoCompleteUL1=$("#autoComplete1");
	var autoCompleteUL2=$("#autoComplete2");
	var latDepart, latArrivee, longDepart, longArrivee;
	var distance, temps, addDepart, addArrivee, type_voiture;

	var barreDeRecherche=$("#barreDeRecherche");
	var autoCompleteBdr=$("#autoCompleteBdr");

	//Récupération de l'historique
	$.ajax({
		url:"./ajax/gethistorique.php"
	}).done(function(result){
		var data=jQuery.parseJSON(result);
		$("#autoComplete3").empty();
		//Si l'historique n'est pas vide
		if(data != "EMPTY")
		{	
			//console.log(data[0].adresse_depart);
			for(var i=0; i<data.length; i++)
			{
				//console.log(data[i].adresse_depart);
				//Remplissage de l'historique
				$("#autoComplete3").append("<li data-latDep='"+data[i].latitude_depart+"\' data-longDep='"+data[i].longitude_depart+"\' data-latArr='"+data[i].latitude_arrive+"\' data-longArr='"+data[i].longitude_arrive+"'>"+data[i].adresse_depart+" - "+data[i].adresse_arrive+"</li>");
			}		
		}
		else
		{
			$("#autoComplete3").append("<li data='default'>Pas d'historique</li>");
		}
	});
	
	//Récupération des favoris
	$.ajax({
		url:"./ajax/getfavoris.php"
	}).done(function(result){
		var data=jQuery.parseJSON(result);
		//Si l'historique n'est pas vide
		if(data != "EMPTY")
		{	
			//Remplissage des favoris
			$("#autoComplete5").empty();
			for(var i=0; i<data.length; i++)
			{
				
				$("#autoComplete5").append("<li data-latDep='"+data[i].latitude_depart+"\' data-longDep='"+data[i].longitude_depart+"\' data-latArr='"+data[i].latitude_arrive+"\' data-longArr='"+data[i].longitude_arrive+"'>"+data[i].adresse_depart+" - "+data[i].adresse_arrive+"</li>");
			}
		}
		else
		{
			$("#autoComplete5").append("<li data='default'>Pas de favoris</li>");
		}
	});

	//Récupération des voitures personnelles d'un utilisateur
	$.ajax({
		url:"./ajax/getvoitures.php"
	}).done(function(result){
		var data=jQuery.parseJSON(result);
		$("#Trans").empty();
		//Si la liste de voitures n'est pas vide
		if(data != "EMPTY")
		{	
			$("#Trans").append("<optgroup label='--Mes Véhicules'>");
			//Remplissage des voitures
			for(var i=0; i<data.length; i++)
			{
				$("#Trans").append("<option value='"+data[i].id+"' data-type='"+data[i].type_moteur+"' data-conso='"+data[i].consommation+"'>"+data[i].marque+" - "+data[i].modele+"</option>");
			}
			$("#Trans").append("</optgroup>");
			$("#Trans").append("<optgroup label='--Véhicules Par Défaut'>");
			for(var i=0; i<3; i++)
			{
				switch(i)
				{
					case 0:
						$("#Trans").append("<option value='"+i+"' data-conso='7'>Voiture</option>");
						break;
					case 1:
						$("#Trans").append("<option value='"+i+"' data-conso='15'>Break</option>");
						break;
					case 2:
						$("#Trans").append("<option value='"+i+"' data-conso='35'>Camion</option>");
						break;
					default:
						break;
				}
			}
			$("#Trans").append("</optgroup>");
		}
		else
		{
			for(var i=0; i<3; i++)
			{
				switch(i)
				{
					case 0:
						$("#Trans").append("<option value='"+i+"' data-conso='7'>Voiture</option>");
						break;
					case 1:
						$("#Trans").append("<option value='"+i+"' data-conso='15'>Break</option>");
						break;
					case 2:
						$("#Trans").append("<option value='"+i+"' data-conso='35'>Camion</option>");
						break;
					default:
						break;
				}
			}
		}
	});

	//Action se déroulant lors du remplissage de l'input de Départ
	adressInput1.on("keyup", function(e){
		$.ajax({
			url: urlApi+"/json?address="+adressInput1.val()+"&key="+key
		}).done(function(result){
			autoCompleteUL1.empty();
			for(var i in result.results)
			{
				var adress=result.results[i].formatted_address;
				var lat=result.results[i].geometry.location.lat;;
				var longit=result.results[i].geometry.location.lng;
				autoCompleteUL1.append("<li data-lat='"+lat+"\' data-long='"+longit+"'>"+adress+"</li>");
			}
			//console.log(result);	
		}).fail(function(result){
			//console.log("ERREUR");
		}).always(function(){
			
		});
	});
	//Action se déroulant lors du remplissage de l'input de Destinantion
	adressInput2.on("keyup", function(e){
		$.ajax({
			url: urlApi+"/json?address="+adressInput2.val()+"&key="+key
		}).done(function(result){
			autoCompleteUL2.empty();
			for(var i in result.results)
			{
				var adress=result.results[i].formatted_address;
				var lat=result.results[i].geometry.location.lat;;
				var longit=result.results[i].geometry.location.lng;
				autoCompleteUL2.append("<li data-lat='"+lat+"\' data-long='"+longit+"'>"+adress+"</li>");
			
			}
			//console.log(result);	
		}).fail(function(result){
			//console.log("ERREUR");
		}).always(function(){
			
		});
	});

	//Action pour la barre de recherche centrale
	barreDeRecherche.on("keyup", function(e){
		$.ajax({
			url: urlApi+"/json?address="+barreDeRecherche.val()+"&key="+key
		}).done(function(result){
			autoCompleteBdr.empty();
			for(var i in result.results)
			{
				var adress=result.results[i].formatted_address;
				var lat=result.results[i].geometry.location.lat;;
				var longit=result.results[i].geometry.location.lng;
				autoCompleteBdr.append("<li data-lat='"+lat+"\' data-long='"+longit+"'>"+adress+"</li>");
			
			}
			//console.log(result);	
		}).fail(function(result){
			//console.log("ERREUR");
		}).always(function(){
			
		});
	});

	//Action du click sur une liste de depart/destination
	$(document).on("click", "#autoComplete1 li", function(e){
		e.preventDefault();
		$("#autoComplete1").empty();
		adressInput1.val($(this).text());
		latDepart=$(this).attr('data-lat');
		longDepart=$(this).attr('data-long');
	});
	$(document).on("click", "#autoComplete2 li", function(e){
		e.preventDefault();
		$("#autoComplete2").empty();
		adressInput2.val($(this).text());
		latArrivee=$(this).attr('data-lat'); 
		longArrivee=$(this).attr('data-long');
	});

	//onclick pour la barre de recherche
	$(document).on("click", "#autoCompleteBdr li", function(e){
		e.preventDefault();
		$("#autoCompleteBdr").empty();
		barreDeRecherche.val($(this).text());
		latitude=$(this).attr('data-lat'); 
		longitude=$(this).attr('data-long');

		var pos = new google.maps.LatLng(latitude, longitude);
		map.setCenter(pos);
		map.setZoom(10);

   		var marker = new google.maps.Marker({
      		position: pos,
      		map: map
  		});

	});
	
	//Action se déroulant lors de la sélection d'un véhicule
	$(document).on("change", "select#Trans", function(){
		//console.log($("select#Trans option:selected").attr("data-type"));
		var optionSelected=$("select#Trans option:selected");
		if(optionSelected.attr("data-type")!=undefined)
		{
			$("select#Carb").attr("disabled", "disabled");
			$("select#Carb").val(optionSelected.attr('data-type'));
		}
		else
		{
			$("select#Carb").removeAttr("disabled");
		}
	});

	//Action sur le click du bouton Lancer
	buttonGeo.on("click", function(){
		var dep={lat:parseFloat(latDepart) , longit:parseFloat(longDepart) , nom:adressInput1.val()};
		var arr={lat:parseFloat(latArrivee) , longit:parseFloat(longArrivee) , nom:adressInput2.val() };
		var idvehic=$('select#Trans option:selected').val();
		var that=this;
		//console.log(idvehic);
		drawItin(dep, arr);
		//Requête ajax pour enregistrer l'historique mis à jour dans la base de données
		$.ajax({
			url: "./ajax/savehistorique.php",
			type : 'POST',
			data: {

					DEP: dep.nom,
					ARR: arr.nom,
					LONGDEP: dep.longit,
					LATDEP: dep.lat,
					LONGARR: arr.longit,
					LATARR: arr.lat,
					IDVEHIC: idvehic

			},
			beforeSend: function(){
				//Ajout du bouton favoris s'il n'existe pas
				if($(that).next().attr("id") != 'btnAddToFavoris')
				{
					$('#btnGeocode').after('<input id="btnAddToFavoris" type="button" value="Ajouter aux favoris" class="btn-style bouton" />');
				}
			},
			async : true
		}).done(function(result){
			//console.log(result);
			//Si l'historique à bien été enregistré dans la base
			if(parseInt(result) != 0)
			{
				//Remplissage de l'historique
				if($('#autoComplete3 li:first-child').attr("data") == undefined)
				{
					
					$("#autoComplete3").append("<li data-latDep='"+dep.lat+"\' data-longDep='"+dep.longit+"\' data-latArr='"+arr.lat+"\' data-longArr='"+arr.longit+"'>"+dep.nom+" - "+arr.nom+"</li>");
				}
				else
				{
					$("#autoComplete3").empty();
					$("#autoComplete3").append("<li data-latDep='"+dep.lat+"\' data-longDep='"+dep.longit+"\' data-latArr='"+arr.lat+"\' data-longArr='"+arr.longit+"'>"+dep.nom+" - "+arr.nom+"</li>");
				}
			}
		});
	});
	//Action sur le click du bouton Ajouter aux favoris
	$(document).on("click", "#btnAddToFavoris", function(){
		//Requête ajax pour enregistrer les favoris mis à jour dans la base de données
		$.ajax({
			url:"./ajax/savefavoris.php",
			type : 'POST',
			beforeSend: function(){
				//Suppression du bouton favoris
				$('#btnAddToFavoris').remove();
			},
			async : true
		}).done(function(result){
			//Remplissage des favoris
			if($('#autoComplete5 li:first-child').attr("data") == undefined)
			{
					
					$("#autoComplete5").append("<li data-latDep='' data-longDep='' data-latArr='' data-longArr=''>"+adressInput1.val()+" - "+adressInput2.val()+"</li>");
			}
			else
			{
					$("#autoComplete5").empty();
					$("#autoComplete5").append("<li data-latDep='' data-longDep='' data-latArr='' data-longArr=''>"+adressInput1.val()+" - "+adressInput2.val()+"</li>");
		
			}
		});
	});
});
//Fonction d'initialisation de la map lors du rafraîchissement de la page
function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var paris=new google.maps.LatLng(48.856614, 2.3522219);
  var mapOptions = {
    zoom: 8,
    center: paris
  }
  map = new google.maps.Map(document.getElementsByClassName("col-md-7")[0], mapOptions);
  directionsDisplay.setMap(map);
}
//pour supprimer les markers + recentrer la map
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}
function suppMarker(){
	setAllMap(null);
}
function suppMarkers(){
	suppMarker();
	markers = [];
	map.setCenter(new google.maps.LatLng(48.856614, 2.3522219));
}

//fonction pour clean l'objet direction
function cleanDirection(){
	directionsDisplay.setMap(null);
}
//Fonction permettant de dessiner l'itinéraire d'un trajet sur la map
//+ remplissage du détail des informations sur le trajet
function drawItin(depart, arrivee){
	directionsDisplay.setMap(map);
 	var Start=new google.maps.LatLng(depart.lat, depart.longit);
 	var End=new google.maps.LatLng(arrivee.lat, arrivee.longit);
    var request = {
      origin: Start,
      destination: End,
      /*
	    google.maps.TravelMode.DRIVING (Default) indicates standard driving directions using the road network.
	    google.maps.TravelMode.BICYCLING requests bicycling directions via bicycle paths & preferred streets.
	    google.maps.TravelMode.TRANSIT requests directions via public transit routes.
	    google.maps.TravelMode.WALKING requests walking directions via pedestrian paths & sidewalks.
    */
      travelMode: google.maps.TravelMode['DRIVING']
  };
  directionsService.route(request, function(response, status) {
    if(status == google.maps.DirectionsStatus.OK) {
    	//console.log(response);
    	var vehic={id:$('select#Trans option:selected').val(),
    				nom:$('select#Trans option:selected').text(),
    				conso:$('select#Trans option:selected').attr("data-conso"),
    				carbu:$('select#Carb option:selected').text()
    			};
      	directionsDisplay.setDirections(response);
      	distance=response.routes[0].legs[0].distance.value;
      	temps=response.routes[0].legs[0].duration.text;
      	addDepart=response.routes[0].legs[0].start_address;
      	addArrivee=response.routes[0].legs[0].end_address;
      	var conso=(vehic.conso*distance)/100000;
    	var trajet={
    		conso: parseFloat(conso),
    		prixDies: coutDies*conso,
    		prixEss: coutEss*conso
    	};
      	//Remplissage de la Partie INFO CONSO
      	$("#autoComplete4").empty();
      	$("#autoComplete4").append("<li data-depart='"+addDepart+"'>Départ : "+addDepart+"</li>");
      	$("#autoComplete4").append("<li data-destination='"+addArrivee+"'>Destination : "+addArrivee+"</li>");
      	$("#autoComplete4").append("<li data-time='"+response.routes[0].legs[0].duration.value+"'>Temps : "+temps+"</li>");
      	$("#autoComplete4").append("<li data-distance='"+distance+"'>Distance : "+Math.round(distance/1000)+" Kilomètres</li>");
    	$("#autoComplete4").append("<li data-type_voiture='"+vehic.id+"'>Locomotion : "+vehic.nom+"</li>");
    	$("#autoComplete4").append("<li data-conso="+vehic.conso+">Consommation : "+vehic.conso+" L/100km</li>");
    	$("#autoComplete4").append("<li data-carbu="+vehic.carbu+">Carburant : "+vehic.carbu+"</li>");
    	$("#autoComplete4").append("<li data-consoTrajet="+trajet.conso+">Consommation Trajet : "+Math.round(trajet.conso*100)/100+" Litres</li>");
    	switch(vehic.carbu)
    	{
    		case "Essence":
    			$("#autoComplete4").append("<li data-prixTrajet="+trajet.prixEss+">Prix Carburant Trajet : "+Math.round(trajet.prixEss*100)/100+" €</li>");
    			break;
    		case "Diesel":
    			$("#autoComplete4").append("<li data-prixTrajet="+trajet.prixDies+">Prix Carburant Trajet : "+Math.round(trajet.prixDies*100)/100+" €</li>");
    			break;
    		default:
    			break;
    	}
    }
  });
}

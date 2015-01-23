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
	var distance, temps, addDepart, addArrivee;
	var barreDeRecherche=$("#barreDeRecherche");
	var autoCompleteBdr=$("#autoCompleteBdr");
	
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
			//console.log("Fin du chargement !");
			/*setTimeout(function(){
				$("#loader").hide();
			}, 500);*/
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
			//console.log("Fin du chargement !");
			/*setTimeout(function(){
				$("#loader").hide();
			}, 500);*/
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
			//console.log("Fin du chargement !");
			/*setTimeout(function(){
				$("#loader").hide();
			}, 500);*/
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

  		markers.push(marker)

	});
	
	//Action sur le click du bouton Lancer
	buttonGeo.on("click", function(){
		var dep={lat:parseFloat(latDepart) , longit:parseFloat(longDepart) , nom:adressInput1.val()};
		var arr={lat:parseFloat(latArrivee) , longit:parseFloat(longArrivee) , nom:adressInput2.val() };
		drawItin(dep, arr);
	});
	//Action sur le click du bouton Ajouter aux favoris
	/*$(document).on("click", "#btnAddToFavoris", function(){
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
			$("#autoComplete5").append("<li data-latDep='' data-longDep='' data-latArr='' data-longArr=''>"+adressInput1.val()+" - "+adressInput2.val()+"</li>");
		});
	});*/
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
      	$("#autoComplete4").append("<li data-distance='"+distance+"'>Distance : "+distance+" mètres</li>");
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

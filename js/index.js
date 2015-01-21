// Mes variables
var urlApi, key;
var map;
//Initialisation de l'api google map
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
// Apres le chargement du document
$(document).ready(function(){
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
	adressInput1.on("keypress", function(e){
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
	adressInput2.on("keypress", function(e){
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
	barreDeRecherche.on("keypress", function(e){
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

	});
	
	//Action sur le click du bouton Lancer
	buttonGeo.on("click", function(){
		var dep={lat:parseFloat(latDepart) , longit:parseFloat(longDepart) , nom:adressInput1.val()};
		var arr={lat:parseFloat(latArrivee) , longit:parseFloat(longArrivee) , nom:adressInput2.val() };
		//console.log(dep);
		drawItin(dep, arr);
		//Remplissage de l'historique
		$("#autoComplete3").append("<li data-latDep='"+dep.lat+"\' data-longDep='"+dep.longit+"\' data-latArr='"+arr.lat+"\' data-longArr='"+arr.longit+"'>"+dep.nom+" - "+arr.nom+"</li>");
		//Requête ajax pour enregistrer l'historique mis à jour dans la base de données
	});
	//Action sur le click du bouton Ajouter aux favoris
	btnAddFav.on("click", function(){
		//Remplissage des favoris
		$("#autoComplete5").append("<li data-latDep='' data-longDep='' data-latArr='' data-longArr=''>"+adressInput1.val()+" - "+adressInput2.val()+"</li>");	
		//Requête ajax pour enregistrer les favoris mis à jour dans la base de données
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
//Fonction permettant de dessiner l'itinéraire d'un trajet sur la map
//+ remplissage du détail des informations sur le trajet
function drawItin(depart, arrivee){
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
      	directionsDisplay.setDirections(response);
      	distance=response.routes[0].legs[0].distance.value;
      	temps=response.routes[0].legs[0].duration.text;
      	addDepart=response.routes[0].legs[0].start_address;
      	addArrivee=response.routes[0].legs[0].end_address;
      	//Remplissage de la Partie INFO CONSO
      	$("#autoComplete4").empty();
      	$("#autoComplete4").append("<li data-depart='"+addDepart+"'>Départ : "+addDepart+"</li>");
      	$("#autoComplete4").append("<li data-destination='"+addArrivee+"'>Destination : "+addArrivee+"</li>");
      	$("#autoComplete4").append("<li data-time='"+response.routes[0].legs[0].duration.value+"'>Temps : "+temps+"</li>");
      	$("#autoComplete4").append("<li data-distance='"+distance+"'>Distance : "+distance+" mètres</li>");
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
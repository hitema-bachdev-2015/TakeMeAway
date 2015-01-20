var marker1;
var marker2;
var direction;

//fn initialize obligatoire pour instanciers tous les objets google.maps
function initialize() {

  var markers = [];

  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP //on peut définir le type de map que l'on veut
  });

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(48.831003,2.265905)
      );
  map.fitBounds(defaultBounds);
  
  var listener = google.maps.event.addListener(map, "idle", function() { 
    map.setZoom(16); 
  google.maps.event.removeListener(listener); 
  });

  // on creer l'input (ui)
  var input = (document.getElementById('depart'));
  /*map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); //permettre de postionner le but direct sur la map*/

  var input2 = (document.getElementById('arrivee'));
  /*map.controls[google.maps.ControlPosition.TOP_LEFT].push(input2);*/

  var searchBox = new google.maps.places.SearchBox((input));// on instancie la barre de recherche

  var searchBox2 = new google.maps.places.SearchBox((input2));

  // on fait appel à l'autocomplete ici
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0; marker1 = markers[i]; i++) {
      marker1.setMap(null);
    }

    // on utilse les counds pour avoir la lat et lng de la position
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // les markers permettent de récupérer toutes les info concernant un lieu
      var marker1 = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker1);

      console.log(marker1)

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

  /* INPUT 2 ********************************************************************** */

  google.maps.event.addListener(searchBox2, 'places_changed', function() {
    var places = searchBox2.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0; marker2 = markers[i]; i++) {
      marker2.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker2 = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker2);

      console.log(marker2)

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

   direction = new google.maps.DirectionsRenderer({
    map   : map
    });

}

function calculate() {
    origin      = document.getElementById('depart').value; // Le point départ
    destination = document.getElementById('arrivee').value; // Le point d'arrivé
    if(origin && destination){
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Mode de conduite
        }
        var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
        directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
            if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
            }
        });
    }
};


//on met à jour le dom dès l'utilisation de ma fonction initialize
google.maps.event.addDomListener(window, 'load', initialize);
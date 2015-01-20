    <div class="container">

      <div class="page-header">
        <h1>TakeMeAway!</h1>
      </div>

      <h3>Rechercher une adresse:</h3>
      <div class="row">
        <div class="col-md-12">(barre de recherche)</div>
      </div>

      <div class="row">
        <div class="col-md-4" style="padding-top: 0;padding-bottom: 0;background-color: #FFF;border: 0;">
          <div class="row">
            <div class="col-md-12">ITINERAIRE
              <label><span>Départ :</span><input id="StartAddress" type="text" /></label>
              <ul id="autoComplete1">
              </ul>
              <label><span>Destination :</span><input id="EndAddress" type="text" /></label>
              <ul id="autoComplete2">
              </ul>
              <label><span>Carburant :</span><select id="Carb"><option value="">Default</option><option value="">Essence</option><option value="">Diesel</option></select></label>
              <label>Transport :<select id="Trans"><option value="default">Default</option><option value="0">Voiture</option><option value="1">Break</option><option value="2">Camion</option></select></label>
              <input id="btnGeocode" type="button" value="Lancer" />
              <input id="btnAddToFavoris" type="button" value="Ajouter aux favoris" />
          </div>
          <div class="row">
            <div class="col-md-12">HISTORIQUE
             <ul id="autoComplete3">
            </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">SUIVI CONSO.
            <ul id="autoComplete4">
            </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">FAVORIS
             <ul id="autoComplete5">
            </ul>
            </div>
          </div>
        </div>
         <div class="col-md-1" style="padding-top: 15px;padding-bottom: 15px;background-color: #FFF;border: 0;">
        </div>
        <div class="col-md-7">
         </div>
    </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <div class="container">

      <div class="page-header">
        <h1>TakeMeAway!</h1>
      </div>

      
      <div class="row">
        <div class="col-md-12">
        	<h4>Localiser une adresse</h4>
          <div id="search">
	            <input id="barreDeRecherche" type="text" />
	            <ul id="autoCompleteBdr"></ul>
            </div>
        </div>
		</div>

      <div class="row">
        <div class="col-md-4" style="padding-top: 0;padding-bottom: 0;background-color: rgba(0, 0, 0, 0);border: 0;">
          <div class="row">
            <div class="col-md-12"><h4><span>ITINERAIRE</span></h4>
              <label for="StartAddress"><span>Départ :</span></label><input id="StartAddress" type="text" />
              <ul id="autoComplete1">
              </ul>
              <label for="EnAddress"><span>Destination :</span></label><input id="EndAddress" type="text" />
              <ul id="autoComplete2">
              </ul>
              <label for="Carb"><span>Carburant :</span></label><select id="Carb"><option value="">Default</option><option value="">Essence</option><option value="">Diesel</option></select>
              <label for="Trans"><span>Transport :</span></label><select id="Trans"><option value="default">Default</option><option value="0">Voiture</option><option value="1">Break</option><option value="2">Camion</option></select>
              <br><br>
              <input id="btnGeocode" type="button" value="Lancer" class="btn-style" />
              <!--<input id="btnAddToFavoris" type="button" value="Ajouter aux favoris" class="btn-style" />-->
          </div>
        </div>
        <div class="row">
           <div class="col-md-12"><h4><span>HISTORIQUE</span></h4>
             <ul id="autoComplete3">
            </ul>
            </div>
          </div>  
    
          <div class="row">
            <div class="col-md-12"><h4><span>SUIVI CONSO.</span></h4>
            <ul id="autoComplete4">
            </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12"><h4><span>FAVORIS</span></h4>
             <ul id="autoComplete5">
            </ul>
            </div>
          </div>
        </div>
       
         <div class="col-md-1" style="padding-top: 15px;padding-bottom: 15px;background-color: rgba(0, 0, 0, 0);border: 0;">
        </div>
        <div class="col-md-7">
         </div>
           <div class="col-md-1" style="padding-top: 15px;padding-bottom: 15px;background-color: #FFF;border: 0;">
        </div>
          
       
  </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

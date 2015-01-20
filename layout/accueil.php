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
            <div class="col-md-12">
              <form action="" method="get" name="direction" id="direction">
                <label>Point de départ :</label>
                  <input id="depart" class="controls" type="text" placeholder="Départ" name="depart">
                <label>Point d'arrivée :</label>
                  <input id="arrivee" class="controls" type="text" placeholder="Arrivée" name="arrivee">     
                <input type="button" value="Calculer l'itinéraire" onclick="javascript:calculate()">
            </form>
              <br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">TOOLS BOX #2
              <br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
          </div>
           <div class="row">
            <div class="col-md-12">TOOLS BOX #3
              <br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
          </div>
           <div class="row">
            <div class="col-md-12">TOOLS BOX #4
              <br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
          </div>
        </div>
         <div class="col-md-1" style="padding-top: 15px;padding-bottom: 15px;background-color: #FFF;border: 0;">
        </div>
        <div class="col-md-7">
           <div id="map-canvas" data-role="page"></div>
        </div>
      </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

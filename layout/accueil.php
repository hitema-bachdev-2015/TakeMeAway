    <div class="container">

      <div class="page-header">
        <h1>TakeMeAway!</h1>
      </div>

      <div class="row">
        <div class="col-md-12">
        	<h4>LOCALISER UNE ADRESSE</h4>
          <div id="search">
	            <input id="barreDeRecherche" type="text" placeholder='Rechercher...' />
	            <ul id="autoCompleteBdr"></ul>
            </div>
        </div>
		</div>
    <?php 
      if(isset($_GET['confirmattion']) && $_GET['confirmattion']=='ok'){
        echo "<div class='notification notOk'>Vous êtes bien connecté sur TakeMeAway.</div>";
      }
    ?>
      <div class="row">
        <div class="col-md-4" style="padding-top: 0;padding-bottom: 0;background-color: rgba(0, 0, 0, 0);border: 0;">
          <div class="row lienConnexion">
            <div class="col-md-12">
              <?php
              if(isset($_SESSION['user']['id']))
              {
              ?>  
                <h4><a href="admin/">Mon compte</a>|<a href="deconnexion.php">Déconnexion</a></h4>
              <?php
              }
              else
              {
              ?>
                <h4><a href="connexion.php">Connexion</a>|<a href="inscription.php">Inscription</a></h4>
              <?php  
              }
              ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <h4>ITINERAIRE</h4>
              <label>
                <span>Départ</span>:
                <input id="StartAddress" type="text" />
                <ul id="autoComplete1"></ul>
              </label>
                <label>
                  <span>Destination</span>:
                  <input id="EndAddress" type="text" />
                </label>
              <ul id="autoComplete2"></ul>
              <label>
                <span>Carburant </span>:
                <select id="Carb">
                  <option value="0">Essence</option>
                  <option value="1">Diesel</option>
                </select>
              </label>
              <label>
                <span>Transport </span>:
                <select id="Trans">
                  <option value="0">Voiture</option>
                  <option value="1">Break</option>
                  <option value="2">Camion</option>
                </select>
              </label>
              <input id="btnGeocode" type="button" value="Lancer" class="btn-style bouton" />
              </div>
        </div>
         <?php
        if(isset($_SESSION['user']['id']))
        {
        ?>
          <div class="row">
             <div class="col-md-12"><h4><span>HISTORIQUE</span></h4>
               <ul id="autoComplete3">
              </ul>
              </div>
            </div>  
        <?php
        }
        ?>
          <div class="row">
            <div class="col-md-12"><h4><span>SUIVI CONSO.</span></h4>
            <ul id="autoComplete4">
            </ul>
            </div>
          </div>
           <?php
          if(isset($_SESSION['user']['id']))
          {
          ?>
            <div class="row">
              <div class="col-md-12"><h4><span>FAVORIS</span></h4>
               <ul id="autoComplete5">
              </ul>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
       
         <div class="col-md-1" style="padding-top: 15px;padding-bottom: 15px;background-color: rgba(0, 0, 0, 0);border: 0;">
        </div>
        <div class="col-md-7">
         </div>
           <div class="col-md-1" style="padding-top: 15px;padding-bottom: 15px;background-color: #f9f9f9;border: 0;">
        </div>
          
       
  </div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

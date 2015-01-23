<div class="container">
   <h1 class="title">Connexion</h1>

    <?php 
      if(isset($_GET['confirmattion']) && $_GET['confirmattion']=='error'){
        echo "<div class='notification notError'>Information érroné ou inexistant .</div>";
      }
    ?>
   <form action="" method="post" id="formConnexion">
      <center>
         <a href="accueil.php" class="bouton">Accueil</a>
      </center>
      <label>
         <span>E-mail </span>:
         <input type="mail" name="login" id="login" value"<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" />
      </label>
      <label id="lfp">
         <span>Mot de passe </span>:
         <input type="password" name="mdp" id="mdp" value="<?php echo isset($_POST['mdp']) ? $_POST['mdp'] : ''; ?>" />
      </label>
      
      <div>
         <input type="button" class="bouton" name="connexion" value="Mot de passe oublié" id="mdpf"/>
         <input type="button" class="bouton" name="connexion" id="btnConnect" value="Se connecter"/>
      </div>      
   </form>
</div>

<script type="text/javascript">

   $("#mdpf").on('click', function(){
      $(this).hide();
      $("#lfp").hide();
      $("#btnConnect").val("Envoyer nouveau MDP par mail");
      $("#btnConnect").attr("type", "submit");
      $("#btnConnect").attr("id", "");
      $("#mdp").hide();
   });

   $("#btnConnect").on('click', function(){
      var login   = $("#login").val();
      var mdp     = $("#mdp").val();

      $.ajax({
         url: 'ajax/connexion.php',
         type: "POST",
         data: {login : login,mdp : mdp}, 
         success: function(data){
            var result=jQuery.parseJSON(data);
            //console.log(result);
            if(result=="EMPTY")
            {
               document.location.href='connexion.html?confirmattion=error';
            }
            else
            {
               document.location.href='accueil.html?confirmattion=ok';
            }
         }
      });
   });
      
</script>
 

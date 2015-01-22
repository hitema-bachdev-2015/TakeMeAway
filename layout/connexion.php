      <h2>Connexion au site</h2>
   
       <form action="accueil.php" method="post">
          
         
               <label>
             <span>E-mail :</span>
               <input type="mail" name="login" id="login" value"<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" />
               </label>
               
              <label id="lfp">
               <span>Mot de passe :</span>
               <input type="password" name="mdp" id="mdp" value="<?php echo isset($_POST['mdp']) ? $_POST['mdp'] : ''; ?>" />
               </label>
         
                  <input type="button" name="connexion" value="Mot de passe oublié" id="mdpf"/>

         <input type="button" name="connexion" id="btnConnect" value="Se connecter"/>
      </form>
<script type="text/javascript">

         $("#mdpf").on('click', function(){
               $(this).hide();
               $("#lfp").hide();
               $("#btnConnect").val("Envoyer nouveau MDP par mail");
               $("#mdp").hide();


            });

   $("#btnConnect").on('click', function(){
      var login = $("#login").val();
      var mdp = $("#mdp").val();

               $.ajax({
                  url: 'ajax/connexion.php',
                  type: "POST",
                  data: {login : login,mdp : mdp}, 
              
      success: function(data){
               //console.log(data);
               var result=jQuery.parseJSON(data);
               if(result!="EMPTY")
               {
                  $('form').submit();
               }
               /*else
               {

               } */
      }

               });
});
      
</script>
 

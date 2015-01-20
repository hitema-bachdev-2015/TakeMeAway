

 
      <?php  
   require_once("header.php"); 
?>

<script type="text/javascript">
$(document).ready(function( event ) {

      $("#mdpf").on('click', function(event){
            event.preventDefault()

            $("#mdp").hide();
            $("#lfp").hide();
            $("#mdpf").val("Envoyer nouveau MDP par mail");
            $("#btnConnect").hide();
         });

});
     
      
</script>
      <h2>Connexion au site</h2>
   
      <form action="connexion.php" method="post">
         
         <table>
            
            <tr>
               
               <td><label for="login"><strong>Adresse Email</strong></label></td>
               <td><input type="text" name="login" id="login" value"<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" /></td>
               
            </tr>
            
            <tr>
               
               <td><label for="pass" id="lfp"><strong>Mot de passe</strong></label></td>
               <td><input type="password" name="mdp" id="mdp" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" /></td>
               
            </tr>
            
         </table>
                  <input type="submit" name="connexion" value="Mot de passe oublié" id="mdpf"/>

         <input type="submit" name="connexion" id="btnConnect" value="Se connecter"/>
      </form>
 

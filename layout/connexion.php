

 
      <?php  
   require_once("header.php"); 
?>

      <h2>Connexion au site</h2>
   
      <form action="connexion.php" method="post">
         
         <table>
            
            <tr>
               
               <td><label for="login"><strong>Email</strong></label></td>
               <td><input type="text" name="login" id="login" value"<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" /></td>
               
            </tr>
            
            <tr>
               
               <td><label for="pass" id="lfp"><strong>Mot de passe</strong></label></td>
               <td><input type="password" name="mdp" id="mdp" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>" /></td>
               
            </tr>
            
         </table>
                  <input type="button" name="connexion" value="Mot de passe oublié" id="mdpf"/>

         <input type="submit" name="connexion" id="btnConnect" value="Se connecter"/>
      </form>
<script type="text/javascript">

         $("#mdpf").on('click', function(){
console.log($(this));
               $(this).hide();
               $("#lfp").hide();
               $("#btnConnect").val("Envoyer nouveau MDP par mail");
               $("#mdp").hide();
            });
      
</script>
 

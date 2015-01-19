<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Take Me Away 0.01</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>

        
        <script src="js/main.js"></script>
        <?php include("script/".$page);
    include("layout/".$page);

    include("include/footer.php");
?>

 <body>
      
      <h2>Connexion au site</h2>
   
      <form action="connexion.php" method="post">
         
         <table>
            
            <tr>
               
               <td><label for="login"><strong>Identifiant</strong></label></td>
               <td><input type="text" name="login" id="login"/></td>
               
            </tr>
            
            <tr>
               
               <td><label for="pass"><strong>Mot de passe</strong></label></td>
               <td><input type="password" name="pass" id="pass"/></td>
               
            </tr>
            
         </table>
         <input type="submit" name="connexion" value="Se connecter"/>
      </form>
   
   </body>    
</html>
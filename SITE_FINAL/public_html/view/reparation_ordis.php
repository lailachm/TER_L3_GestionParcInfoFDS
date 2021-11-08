<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

if (!isset($_SESSION['username'])) {
	header('Location: ../index.php');
}
else {
        $now = time(); // Checking the time now when home page starts.

        if ($now > $_SESSION['expire']) {
        	session_destroy();
        	header('Location: ../index.php');
        }
    }
?>

<!DOCTYPE html>
<html>

<?php include $include_path . 'header.php' ?>

<body>

	<br>

	<?php include $include_path . 'menu.php' ?>

	<div class="global">
	  

		<h1 class="h1_global"> ORDINATEURS EN RÉPARATION </h1>

		<div class="corps_global">
		    
			<div class="div_global">
				<h2 class="h2_global">
				    
				    
				    		     
<?php
$dsn = 'mysql:dbname=id12901849_parinfofds;host=localhost';
$user = 'id12901849_parinfofds';
$password = 'parcinfo';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   // "SELECT * FROM ordinateur WHERE etat LIKE '$categorie'"
   // 
   $categorie = "En réparation";
    $reponse = $dbh->query("select * from Ordinateur where Etat like '%".$categorie."%'");
     
              
        
        if (!empty($_POST['categorie']))
        {
        $categorie=$_POST['categorie'];
        }else{
        $categorie='%';
        }
       
        
        
               while ($donnees = $reponse->fetch())
               {
                
        
        ?>
      
         
      <table border='1'>
             
                            <th> n° Série</th>
                            <th> Type </th>
                            <th> Model</th>
                            <th> Etat</th>
                            <th> Statut </th>
                            <th> Nb année garantie </th>
                            <th> Remarque </th>
 <tr>
 <td width=120px><?php echo $donnees['NumSerie']; ?></td>
<td width=120px> <?php echo $donnees['Typee']; ?></td>
<td width=120px><?php echo $donnees['Modele']; ?></td>
<td width=120px><?php echo $donnees['Etat']; ?></td>
<td width=120px><?php echo $donnees['Statut']; ?></td>
<td width=120px><?php echo $donnees['NbrAnneGarantie']; ?></td>
<td width=120px><?php echo $donnees['Remarque']; ?></td>
</tr>
         
         
         
         
        <?php   
             }
            
              $reponse->closeCursor(); // Termine le traitement de la requête
 
              
 
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}
			?>	    

			
				</h2>

			</div>

			
           <!--<//?php include $include_path . 'footer.php' ?>-->
			
		</div>

	</div>
     
	<br>
</body>
</html>
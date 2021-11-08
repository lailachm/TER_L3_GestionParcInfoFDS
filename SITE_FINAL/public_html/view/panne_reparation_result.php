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
	   

		<h1 class="h1_global"> ORDINATEURS EN PANNE / EN REPARATION</h1>

		<div class="corps_global">
		    
		    <div class="div_global">
				<h2 class="h2_global">Ordinateurs en panne / en réparation</h2>
	
					<label id="label_inventaire"> Votre sélection :</label>
					
					<br/>
					<br/>
					
					
					
					<?php



if(isset($_POST['modifier'])) {
    
    
    if ($_POST['choix'] == "%"){
      $msg ="Recherche vide!";
      echo $msg;
    }
    else {


try { ?>
     </br>
        </br>
         
      <table border='1'>
          
                            <th> n° Série</th>
                            <th> Type </th>
                            <th> Model</th>
                            <th> Etat</th>
                            <th> Statut </th>
                            <th> Nb année garantie </th>
                            <th> Remarque </th>
                            <th> Email </th>
                            <th> N° de téléphone </th>
                            
                            <?php
                            
     require_once $model_path . 'model.php';
panne_reparation_result(); 
        ?>
       
                            
                            
             <?php
 
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

}
}

			?>	

       
      </table>
       <br/>
       <br/>
		</div>
		
		</div>

	</div>

</body>

</html>
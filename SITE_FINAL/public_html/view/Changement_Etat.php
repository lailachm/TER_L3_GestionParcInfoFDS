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
	   

		<h1 class="h1_global"> CHANGEMENT D'ETAT </h1>


		<div class="corps_global">
		   
		    	<!-- MESSAGES D'ALERTE -->

			<?php if (isset($_GET['status']) && $_GET['status'] == "reussi") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					Modification effectuée !
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "err") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					Veuillez choisir le nouveau état des ordinateurs selectionné dans le panier.
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "horsinv") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					La modification a échouée, l'ordinateur est hors de l'inventaire UM.
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "panniervide") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					Votre panier est vide. 
				</div>
			<?php endif ?>

			<!-- FIN MESSAGES D'ALERTE -->
		    
		    
		    
		    
		    
			<div class="div_global">
				

				<h2 class="h2_global">Changement d'état </h2>

			
					<label id="label_inventaire">Nouvel état :</label>
					
					<br/>

               <form method="post" <?php echo 'action="' . $controller_path . 'Changement_Etat.php' . '"';?>>

					<input type="radio" value="En panne" name="id"> <label>En panne</label>
					<br>
					<input type="radio" value="Fonctionnel" name="id"> <label>Fonctionnel</label>
					<br>
					<input type="radio" value="En reparation" name="id"> <label>En réparation</label>
					<br>
					<br>
					
					
			

					<button type="submit" name ="modifier">Valider</button>
				</form>
	
			
	             <h2 class="h2_global">Panier</h2>
				<table class="table table-striped" id="shopping_cart">
					
				</table>
				<br>
				<br>
			</div>
	
			

		</div>

	</div>

	<br>
</body>
</html>


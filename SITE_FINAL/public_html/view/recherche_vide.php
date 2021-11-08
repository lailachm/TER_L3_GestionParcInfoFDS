<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';
?>

<!DOCTYPE html>
<html>

<?php include $include_path . 'header.php' ?>

<body>

	<br>

	<?php include $include_path . 'menu.php' ?>

	<div class="global">

		<h1 class="h1_global"> SELECTION </h1>

		<div class="corps_global">
		    
		   
		    
			<div class="div_global"> 
			<h2 class="h2_global">Résultats de votre recherche : </h2>
			
			<!-- MESSAGES D'ALERTE -->

			<?php if (isset($_POST['submit']) && (empty($_POST['NumSerie'])) && (empty($_POST['IdLieu'])) && (empty($_POST['NumBatiment'])) && (empty($_POST['choix'])) && (empty($_POST['choixG'])) && empty($_POST['test']) && (empty($_POST['choixS']))) : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					Vous n'avez fait aucune recherche veuillez faire un retour à la recherche !!
				</div>
			<?php endif ?>  

			<!-- FIN MESSAGES D'ALERTE --> 
			
			
			 <a class="add" href="recherche.php ">
            <input name = "submit" style= "padding-left: 50px; padding-right : 50px;" type="submit" value="Retour à la recherche">
            </a>
            <br/>
			</div>

		</div>

	</div>

	<br>
</body>
</html>
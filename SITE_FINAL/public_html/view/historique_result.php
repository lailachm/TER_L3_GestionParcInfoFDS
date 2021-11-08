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

require_once $model_path . 'model.php';

if(isset($_POST['rech_hist']) && isset($_POST['fiche_hist']) && isset($_POST['date_debut']) && isset($_POST['date_fin']) ){

	$date_d = $_POST['date_debut'];
	$date_debut = implode('-',array_reverse (explode('/',$date_d)));
	$date_f = $_POST['date_fin'];
	$date_fin = implode('-',array_reverse (explode('/',$date_f)));
	$array = getHist($date_debut, $date_fin, $_POST['fiche_hist']);
	
	if(!empty($array)){

		?>

		<!DOCTYPE html>
		<html>

		<?php include $include_path . 'header.php' ?>

		<body>

			<br>

			<?php include $include_path . 'menu.php' ?>

			<div class="global">
			    

				<h1 class="h1_global"> FICHES INVENTAIRE </h1>
                
				<div class="corps_global">
				    
					<div class="div_global">
						<h2 class="h2_global">Génération des fiches inventaire : <?php echo $_POST['fiche_hist']; ?> d'inventaire</h2>
						<br>
						<?php if($_POST['fiche_hist'] == 'Entrée') : ?>
							<a href="entree_historique.csv" download> Télécharger le fichier .csv récapitulatif </a>
						<?php endif ?>
						<?php if($_POST['fiche_hist'] == 'Modification') : ?>
							<a href="modification_historique.csv" download> Télécharger le fichier .csv récapitulatif </a>
						<?php endif ?>
						<?php if($_POST['fiche_hist'] == 'Sortie') : ?>
							<a href="sortie_historique.csv" download> Télécharger le fichier .csv récapitulatif </a>
						<?php endif ?>
						
						<br>
						<br>
						<br>

						<table id="table_hist">
							<?php if($_POST['fiche_hist'] == 'Entrée') include $include_path . 'hist_tableau_entree.php' ?>
							<?php if($_POST['fiche_hist'] == 'Modification') include $include_path . 'hist_tableau_modification.php' ?>
							<?php if($_POST['fiche_hist'] == 'Sortie') include $include_path . 'hist_tableau_sortie.php' ?>
							<?php 
							printHist($array);
						}else{
							header('Location: ' . $view_path . 'historique.php?status=vide');
							exit();
						}


					}
					
					else{
						header('Location: ' . $view_path . 'historique.php?status=vide');
						exit();
					}

					?>
				</table>
				<br>
				<br>
				<?php $array_result = getHistArray($array);
				historiqueCsv($array_result, $_POST['fiche_hist']); ?>
			</div>

			<?php include $include_path . 'footer.php' ?>
		</div>

	</div>

	<br>
</body>
</html>
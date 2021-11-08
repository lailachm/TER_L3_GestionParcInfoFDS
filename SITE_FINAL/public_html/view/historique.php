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
	   

		<h1 class="h1_global"> FICHES INVENTAIRE </h1>

		<div class="corps_global">
            
			<!-- MESSAGES D'ALERTE -->

			<?php if (isset($_GET['status']) && $_GET['status'] == "vide") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					Aucun résultat ne correspond à votre recherche.
				</div>
			<?php endif ?>

			<!-- FIN MESSAGES D'ALERTE -->

			<div class="div_global">

				<h2 class="h2_global">Génération des fiches inventaire</h2>

				<form method="post" action="historique_result.php" >

					<input type="radio" value="Entrée" name="fiche_hist"> <label>Entrée d'inventaire</label>
					<br>
					<input type="radio" value="Modification" name="fiche_hist"> <label>Modification d'inventaire</label>
					<br>
					<input type="radio" value="Sortie" name="fiche_hist"> <label>Sortie d'inventaire</label>
					<br>
					<br>

					<label>Période : </label> de <input type="date" name="date_debut"> à <input type="date" name="date_fin">
					<br>
					<br>

					<input type="submit" name="rech_hist">

				</form>

				<br>
				<br>

			</div>

			<?php include $include_path . 'footer.php' ?>

		</div>

	</div>

	<br>
</body>
</html>
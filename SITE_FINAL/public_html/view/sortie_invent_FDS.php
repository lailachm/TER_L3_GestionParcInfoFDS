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
	    

		<h1 class="h1_global"> SORTIE INVENTAIRE FDS DANS UM </h1>

		<div class="corps_global">

			<!-- MESSAGES D'ALERTE -->
			<?php if (isset($_GET['status']) && $_GET['status'] == "panierVide" && $_SESSION['totalPanier']== 0): ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					Le panier est vide !
				</div>
			<?php endif ?>

			<?php if (isset($_GET['status']) && $_GET['status'] == "reussi" && $_SESSION['totalPanier'] != 0 ) : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					Modification effectuée !
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "err") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					La modification a échouée.
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "horsinv") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					La modification a échouée, l'ordinateur est hors de l'inventaire UM.
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "dejamodif") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					La modification a échouée, l'ordinateur a déjà été modifié aujourd'hui.
				</div>
			<?php endif ?>

			<!-- FIN MESSAGES D'ALERTE -->

			<div class="div_global">

				<h2 class="h2_global">Sortie inventaire FDS dans UM</h2>

				<h3 id="h3_modif_inv">Nouvel emplacement</h3>

				<form method="post" <?php echo 'action="' . $controller_path . 'sortie_invent_FDS.php' . '"';?> >
					<label id="label_inventaire">Nouveau lieu :</label>
					<select name="nv_lieu" size="1" >
						<option value=""></option>
						<?php require_once $model_path . 'model.php';
						printLieuHorsFDS(); ?>
					</select>
					<br>
					<br>
					<label id="label_inventaire">Nouveau centre responsable :</label>
					<select name="nv_CR_ordi" size="1" >
						<option value=""></option>
						<?php require_once $model_path . 'model.php';
						printCRHorsFDS(); ?>
					</select>
					<br>
					<br>

					<button type="submit" id="modifier" name ="modifier">Valider</button>
					<br>
					<br>
				</form>

				<h2 class="h2_global">Panier</h2>
				<table class="table table-striped" id="shopping_cart">
					
				</table>
				<br>
				<br>
			</div>

			<?php include $include_path . 'footer.php' ?>
		</div>

	</div>

	<br>
</body>
</html>

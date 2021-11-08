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
	  

		<h1 class="h1_global"> SORTIE UM </h1>

		<div class="corps_global">

			<!-- MESSAGES D'ALERTE -->

			<?php if (isset($_GET['status']) && $_GET['status'] == "reussi") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					Sortie effectuée !
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "err") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					La sortie a échouée.
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "horsinv") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					La sortie a échouée, l'ordinateur est déjà hors de l'inventaire UM.
				</div>
			<?php endif ?>
			<?php if (isset($_GET['status']) && $_GET['status'] == "dejamodif") : ?>
				<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
					La sortie a échouée, l'ordinateur a déjà été modifié aujourd'hui.
				</div>
			<?php endif ?>

			<!-- FIN MESSAGES D'ALERTE -->

			<div class="div_global">

				<h2 class="h2_global">Sortir de l'inventaire UM</h2>

				<form method="post" <?php echo 'action="' . $controller_path . 'sortie_UM.php' . '"';?> >
					<label id="label_inventaire">Détails sortie :</label>
					<br>
					<br>
					<textarea name="commentaire" rows="5" cols="40" placeholder="Votre commentaire ici" id="textarea_sortieUM"></textarea>
					<br>
					<br>

					<button type="submit" name ="sortir">Valider</button> 
				</form>
				<br>

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
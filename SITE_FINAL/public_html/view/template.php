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

		<h1 class="h1_global"> INVENTAIRE </h1>

		<div class="corps_global">
		    <form method="get" action="recherche.php">
                <input type="image" src="../public/images/fleche.png" value="2" style="width: 50px" name="Recherche">
            </form>
		    
			<div class="div_global">
				<h2 class="h2_global">Titre</h2>

			</div>

			<div class="div_global">
				<h2 class="h2_global">Titre</h2>

			</div>

			<?php include $include_path . 'footer.php' ?>
		</div>

	</div>

	<br>
</body>
</html>
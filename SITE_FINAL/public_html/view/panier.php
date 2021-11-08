<?php
//index.php
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';
session_start();
include $include_path . 'header.php' 
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<br>

	<?php include $include_path . 'menu.php' ?>

	<div class="global">
	  
		<h1 class="h1_global"> PANIER </h1>

		<div class="corps_global">
		    
			<div class="div_global"> 

				<h2 class="h2_global">Le contenu du panier :  </h2>
				
				<table class="table table-striped" id="shopping_cart">
					
				</table>
				<br>
				<br>

				<button type="button" name="clear_cart" id="clear_cart" class="btn btn-warning btn-xs">Vider le panier</button>
				<br>
				<br>

			</div>
		</div>

	</div>

</body>
</html>
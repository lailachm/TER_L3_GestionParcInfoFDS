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
        
        
		<h1 class="h1_global"> EDITION CARACTERISTIQUES </h1>
        
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
					Veuillez remplissez au moins un champs !
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
			
					<h2 class="h2_global">Edition des caractériqtiques : </h2>

			
					<label id="label_inventaire"> Remplissez les champs que vous voulez mettre à jour :</label>
					
					<br/>
					<br/>
	
		
		<form method="post"  <?php echo 'action="' . $controller_path . 'edition_carac.php' . '"';?> >
		     <label id="id1">Type :</label>
             <input type="text" name="id1" placeholder="ex : Workstation">
             
             <label id="id2">N° d'immobilisation :</label>
             <input type="text" name="id2" placeholder="ex : 10LFH472">
             <br>
             <br>
             

             <label id="id3">Modèle: </label>
             <input type="text" name="id3" placeholder="ex : Optiplex 7440 AIO">

             <label id="id4">N° inventaire :</label>
             <input type="text" name="id4" placeholder="ex : UM004000">
             <br>
             <br>
             
             <label id="id5">Remarque :</label>
             <input type="text" name="id5" placeholder="ex : Manque souris">
             
             <label id="id6">Nombre d'années de garantie :</label>
             <input type="number" name="id6" >
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

	
	
	
	
	
</body>
</html>


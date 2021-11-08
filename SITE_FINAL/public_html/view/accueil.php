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

		<h1 class="h1_global"> ACCUEIL </h1>

		<div class="corps_global">
			<div class="div_global">
				
				 <div class="div_global">
				<h2 class="h2_global">Gestion de parc informatique</h2>
				   <b> Bienvenue sur l'application web de Gestion de parc informatique de l'Université des Sciences de Montpellier.</b>
				<br><br/>
				    La gestion d'un parc informatique est nécessaire pour gérer le système d’information. 
				<br><br/>
				    Cette solution est capable de construire un inventaire de toutes les ressources de la faculté. 
                <br><br/>
				    Les fonctionnalités de cette solution aident les Administrateurs IT à créer une base de données regroupant des ressources techniques et de gestion.
				<br><br/>
				    Cette application a été conçue et développée par un groupe d'étudiant de troisième année de Licence Informatique :
				    	<br><br/> ALAOUI YOUSFI Khaoula - CHAMROUK Laila - EL OUAZZANI Soukaina - LAAFOU Ayoub - MAJDOUL Kaoutar
		    
				
				
				
				
			</div>

			<?php include $include_path . 'footer.php' ?>
		</div>

	</div>

	<br>

</body>
</html>
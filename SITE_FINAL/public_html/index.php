<?php

session_start();
$path = $_SERVER['PHP_SELF'];
$file = basename ($path);
//header('Location: view/accueil.php');
if (isset($_SESSION['username'])) {
	header('Location: view/accueil.php');
	

} 
?>

<html>
<head>
	<meta charset="utf-8">
	<!-- importer le fichier de style -->
	<link rel="stylesheet" href="public/CSS/style.css" media="screen" type="text/css" />
	<title>Gestion du Parc Informatique de la FDS</title>
</head>
<body>
	<h1 id="titre"> Gestion du Parc Informatique de la FDS </h1>
	<div id="container_index">
		<!-- zone de connexion -->

		<form action="controller/verification.php" method="POST">
			<h1 id="h1_index">Connexion</h1>
			<br>
	    	<a id="champ_index">
				<label><b>Nom d'utilisateur</b></label>
				<input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
			</a>
			<br>
			<br>

			<a id="champ_index">
				<label><b>Mot de passe</b></label>
				<input type="password" placeholder="Entrer le mot de passe" name="password" required>
			</a>
			<br>
			<br>

			<a id="champ_index">
				<center><input type="submit" id='submit' value='LOGIN' ></center>
			
			</a>
				<label><center>En poursuivant votre navigation vous acceptez l'utilisation des cookies.</center></label>
			<br>
			<br>
			<?php
			if(isset($_GET['erreur'])){
				$err = $_GET['erreur'];
				if($err==1 || $err==2)
					echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
			}
			?>
		</form>
	</div>
</body>
</html>
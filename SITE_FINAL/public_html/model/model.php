<?php
//ajout des variables path
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';


function dbConnect(){
	try {
		$error = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$db = new PDO('mysql:host=localhost;dbname=id12901849_parinfofds;charset=utf8','id12901849_parinfofds','parcinfo', $error);
		return $db;
	} 
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
}

function addCommande($IdCommandeSIFAC, $Fournisseur, $DateDebutGarantie, $IdCR){
	$bdd = dbConnect();

	$req = $bdd->prepare('INSERT INTO Commande 
		(IdCommandeSIFAC, Fournisseur, DateDebutGarantie, IdCR) 
		VALUES 
		(:IdCommandeSIFAC, :Fournisseur, :DateDebutGarantie, :IdCR)');

	$req->execute(array(
		'IdCommandeSIFAC' => $IdCommandeSIFAC,
		'Fournisseur' => $Fournisseur,
		'DateDebutGarantie' => $DateDebutGarantie,
		'IdCR' => $IdCR
	));
}

function addCommandeNull($Fournisseur, $DateDebutGarantie, $IdCR){
	$bdd = dbConnect();

	$req = $bdd->prepare('INSERT INTO Commande 
		(Fournisseur, DateDebutGarantie, IdCR) 
		VALUES 
		(:Fournisseur, :DateDebutGarantie, :IdCR)');

	$req->execute(array(
		'Fournisseur' => $Fournisseur,
		'DateDebutGarantie' => $DateDebutGarantie,
		'IdCR' => $IdCR
	));
}

function getNumCommande($IdCommandeSIFAC, $Fournisseur, $DateDebutGarantie, $IdCR){
	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT NumCommande FROM Commande WHERE IdCommandeSIFAC = :IdCommandeSIFAC AND Fournisseur = :Fournisseur AND DateDebutGarantie = :DateDebutGarantie AND IdCR = :IdCR ORDER BY NumCommande DESC LIMIT 1');

	$req->execute(array(
		'IdCommandeSIFAC' => $IdCommandeSIFAC,
		'Fournisseur' => $Fournisseur,
		'DateDebutGarantie' => $DateDebutGarantie,
		'IdCR' => $IdCR
	));

	$resultat = $req->fetch();

	return $resultat['NumCommande'];
}

function getNumCommandeNull($Fournisseur, $DateDebutGarantie, $IdCR){
	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT NumCommande FROM Commande WHERE Fournisseur = :Fournisseur AND DateDebutGarantie = :DateDebutGarantie AND IdCR = :IdCR ORDER BY NumCommande DESC LIMIT 1');

	$req->execute(array(
		'Fournisseur' => $Fournisseur,
		'DateDebutGarantie' => $DateDebutGarantie,
		'IdCR' => $IdCR
	));

	$resultat = $req->fetch();

	return $resultat['NumCommande'];
}

function addOrdi($NumSerie, $Typee, $Modele, $NumImmobilisation, $Fabricant, $NumInventaire, $Etat, $Statut, $detailSortieInventaire, $Remarque, $NbrAnneGarantie, $dateDebutGestion, $IdCR, $NumCommande, $IdLieu){
	$bdd = dbConnect();

	$req = $bdd->prepare('INSERT INTO Ordinateur 
		(NumSerie, Typee, Modele, NumImmobilisation, Fabricant, NumInventaire, Etat, Statut, detailSortieInventaire, Remarque, NbrAnneGarantie, dateDebutGestion, IdCR, NumCommande, IdLieu) 
		VALUES 
		(:NumSerie, :Typee, :Modele, :NumImmobilisation, :Fabricant, :NumInventaire, :Etat, :Statut, :detailSortieInventaire, :Remarque, :NbrAnneGarantie, :dateDebutGestion, :IdCR, :NumCommande, :IdLieu)');
	//echo 'ok';

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'Typee' => $Typee,
		'Modele' => $Modele,
		'NumImmobilisation' => $NumImmobilisation,
		'Fabricant' => $Fabricant,
		'NumInventaire' => $NumInventaire,
		'Etat' => $Etat,
		'Statut' => $Statut,
		'detailSortieInventaire' => $detailSortieInventaire,
		'Remarque' => $Remarque,
		'NbrAnneGarantie' => $NbrAnneGarantie,
		'dateDebutGestion' => $dateDebutGestion,
		'IdCR' => $IdCR,
		'NumCommande' => $NumCommande,
		'IdLieu' => $IdLieu));
}

function printCR(){

	$bdd = dbConnect();

	$reponse = $bdd->query('SELECT * FROM CentreResponsable');

	while ($donnees = $reponse->fetch())
	{
		echo '<option value=" ' . $donnees['IdCR'] . ' "> ' . $donnees['NomCR'] . ' </option>';
	}

}

function printCRHorsFDS(){

	$bdd = dbConnect();

	$reponse = $bdd->query('SELECT * FROM CentreResponsable where codeCR <> 1890');
	
	while ($donnees = $reponse->fetch())
	{
		echo '<option value=" ' . $donnees['IdCR'] . ' "> ' . $donnees['NomCR'] . ' </option>';
	}
	
}

function printLieu(){

	$bdd = dbConnect();

	$reponse = $bdd->query('SELECT * FROM Lieu');

	while ($donnees = $reponse->fetch())
	{
		echo '<option value="' . $donnees['IdLieu'] . '" class=" ' . $donnees['NumBatiment'] . ' "> ' . $donnees['IdLieu'] . ' </option>';
	}

}

function printLieuHorsFDS(){

	$bdd = dbConnect();

	$reponse = $bdd->query('SELECT * FROM Lieu WHERE numCampus <> 1');

	while ($donnees = $reponse->fetch())
	{
		echo '<option value="' . $donnees['IdLieu'] . '"> ' . $donnees['IdLieu'] . ' </option>';
	}
	
}

function sameNumSerie($NumSerie){

	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT * FROM Ordinateur WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function sameNumImmo($NumImmobilisation){

	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT * FROM Ordinateur WHERE NumImmobilisation = :NumImmobilisation');

	$req->execute(array(
		'NumImmobilisation' => $NumImmobilisation
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function sameNumInv($NumInventaire){

	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT * FROM Ordinateur WHERE NumInventaire = :NumInventaire');

	$req->execute(array(
		'NumInventaire' => $NumInventaire
	));

	$nbr=$req->rowCount();

	return $nbr;
	
}

function sameSIFAC($IdCommandeSIFAC, $Fournisseur, $DateDebutGarantie, $IdCR){

	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT * FROM Commande WHERE IdCommandeSIFAC = :IdCommandeSIFAC AND Fournisseur = :Fournisseur AND DateDebutGarantie = :DateDebutGarantie AND IdCR = :IdCR');

	$req->execute(array(
		'IdCommandeSIFAC' => $IdCommandeSIFAC,
		'Fournisseur' => $Fournisseur,
		'DateDebutGarantie' => $DateDebutGarantie,
		'IdCR' => $IdCR
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function getHist($dateDebut, $dateFin, $typeFiche){

	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT InfoFicheInventaire FROM Gere_Par_Hist WHERE dateFinGestion BETWEEN :dateDebut AND :dateFin AND typeFiche = :typeFiche');

	$req->execute(array(
		'dateDebut' => $dateDebut,
		'dateFin' => $dateFin,
		'typeFiche' => $typeFiche
	));

	$array = array();
	$resultat = $req->fetchAll();
	$num=$req->rowCount();
	for($c=0; $c<$num; $c++){
		array_push($array, $resultat[$c]['InfoFicheInventaire']);
	}

	return $array;

}

function printHist($array){

	foreach ($array as $i => $value) {
		$hist = explode(";", $array[$i]);
		$num = count($hist);
		echo "<tr>";
		for ($c=0; $c < $num; $c++):
			if($hist[$c] != ""){
				echo "<td id='cell_hist'>" . $hist[$c] . "</td>";
			}
			else{
				if($hist[$c] == "NULL"){
				echo "<td id='cell_hist'> </td>";
			}
			}
		endfor;
		echo "</tr>";
	}	

}

function getHistArray($array){

	$array_result=array();

	foreach ($array as $i => $value){
		$hist = explode(";", $array[$i]);
		array_push($array_result, $hist);
	}

	return $array_result;

}

function historiqueCsv($array, $typeFiche){

	if($typeFiche == "Entrée"){ //A MODIFIER
		$fp = fopen("entree_historique.csv", "w");
		$keys = array ("Nom Responsable de la commande", "Prénom Responsable de la commande", "Téléphone Responsable de la commande", "Mail Responsable de la commande", "Centre Responsable Responsable de la commande", "N° commande SIFAC", "Modèle", "Type", "Fabricant", "Fournisseur", "N° série", "N° campus", "N° bâtiment", "N° niveau", "N° salle", "Date de mise en service", "N° Immobilisation", "N° Inventaire", "Nom Responsable de l'ordinateur", "Prénom Responsable de l'ordinateur", "Téléphone Responsable de l'ordinateur", "Mail Responsable de l'ordinateur");
		fputcsv($fp,$keys);
	}
	else{
		if($typeFiche == "Modification"){ //A MODIFIER
			$fp = fopen("modification_historique.csv", "w");
			$keys = array ("Modèle", "Type", "Fabricant", "N° série", "Ancien N° campus", "Ancien N° bâtiment", "Ancien N° niveau", "Ancien N° salle", "Nouveau N° campus", "Nouveau N° bâtiment", "Nouveau N° niveau", "Nouveau N° salle", "N° Immobilisation", "N° Inventaire", "Date de modification", "Nom Ancien Responsable de l'ordinateur", "Prénom Ancien Responsable de l'ordinateur", "Téléphone Ancien Responsable de l'ordinateur", "Mail Ancien Responsable de l'ordinateur", "Nom Responsable de l'ordinateur", "Prénom Responsable de l'ordinateur", "Téléphone Responsable de l'ordinateur", "Mail Responsable de l'ordinateur");
			fputcsv($fp,$keys);
		}
		else{
			if($typeFiche == "Sortie"){ //A MODIFIER
				$fp = fopen("sortie_historique.csv", "w");
				$keys = array ("Modèle", "Type", "Fabricant", "N° série", "N° campus", "N° bâtiment", "N° niveau", "N° salle", "N° Immobilisation", "N° Inventaire", "Détails sortie", "Date de sortie", "Nom Responsable de l'ordinateur", "Prénom Responsable de l'ordinateur", "Téléphone Responsable de l'ordinateur", "Mail Responsable de l'ordinateur");
				fputcsv($fp,$keys);
			}
		}
	}
	
	foreach($array as $fields):
		$num = count($fields);
		$hist_final = array();
		for ($c=0; $c < $num; $c++):
			if($fields[$c] != ""){
				array_push($hist_final, $fields[$c]);
			}
		endfor;
		fputcsv($fp, $hist_final);
	endforeach;
	fclose($fp);	

}

function sameLieu($IdLieu){
	
	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT * FROM Lieu WHERE IdLieu = :IdLieu');

	$req->execute(array(
		'IdLieu' => $IdLieu
	));

	$nbr=$req->rowCount();

	return $nbr;

}



function ordiRenouv(){
	$bdd = dbConnect();
	$req= $bdd->query('SELECT COUNT(NumSerie) AS compt, NumSerie, Commande.DateDebutGarantie, O1.NbrAnneGarantie, O1.idLieu, O1.Typee, O1.Modele, O1.Etat, Commande.DateDebutGarantie, O1.NbrAnneGarantie, ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie  
	FROM Ordinateur O1,Commande
	 WHERE O1.NumCommande=Commande.NumCommande 
	 AND SYSDATE()>(SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie 
	 	FROM Ordinateur O2,Commande 
		WHERE Commande.NumCommande=O2.NumCommande AND O2.NumSerie=O1.NumSerie) 
	GROUP BY NumSerie');
    $compt = 0;
		while($donnees = $req->fetch()){
		    $compt +=1;
			echo '
			
			<tr>
		
			<td width=120px>' . $donnees['idLieu'] . '</td>
			<td width=120px>' . $donnees['NumSerie'] . '</td>
			<td width=120px>' . $donnees['Typee'] . '</td>
			<td width=120px>' . $donnees['Modele'] . '</td>
			<td width=120px>' . $donnees['Etat'] . '</td>
			<td width=120px>' . $donnees['DateDebutGarantie'] . '</td>
			<td width=120px>' . $donnees['DateFinGarantie'] . '</td>
			<td width=120px>' . $donnees['NbrAnneGarantie'] . '</td>
				</tr>
			
			';
			  
			  
		}
		echo '	</br> Il y a '. $compt . ' ordinateur(s) à renouveler.';
	}
function ordiRenouvDate($date){
	$bdd = dbConnect();


	$d =  str_replace("-", "", $date);
		$requete=$bdd->query("SELECT COUNT(NumSerie) AS compt, NumSerie, Commande.DateDebutGarantie, O1.NbrAnneGarantie, O1.idLieu, O1.Typee, O1.Modele, O1.Etat, Commande.DateDebutGarantie, O1.NbrAnneGarantie, ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie  
		FROM Ordinateur O1,Commande
		 WHERE O1.NumCommande=Commande.NumCommande 
		 AND'".$d."' >(SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie 
			 FROM Ordinateur O2,Commande 
			WHERE Commande.NumCommande=O2.NumCommande AND O2.NumSerie=O1.NumSerie) 
			GROUP BY NumSerie");
       $compt=0;
      
		while($donnees = $requete->fetch()){
		    $compt+=1;
		
			echo'
			<tr>
			<td width=120px>' . $donnees['idLieu'] . '</td>
			<td width=120px>' . $donnees['NumSerie'] . '</td>
			<td width=120px>' . $donnees['Typee'] . '</td>
			<td width=120px>' . $donnees['Modele'] . '</td>
			<td width=120px>' . $donnees['Etat'] . '</td>
			<td width=120px>' . $donnees['DateDebutGarantie'] . '</td>
			<td width=120px>' . $donnees['DateFinGarantie'] . '</td>
			<td width=120px>' . $donnees['NbrAnneGarantie'] . '</td>
			</tr>
			
			';
			
			  
		}
	
	echo '	</br> Il y a '. $compt . ' ordinateur(s) à renouveler.';
}


function printBatiment(){

	$bdd = dbConnect();

	$reponse = $bdd->query('SELECT DISTINCT NumBatiment FROM Lieu');

	while ($donnees = $reponse->fetch())
	{
		echo '<option value="' . $donnees['NumBatiment'] . '"> ' . $donnees['NumBatiment'] . ' </option>';
	}

}

// function test(){

// 	$NumInventaire='%';

// 	$bdd = dbConnect();

// 	$req = $bdd->prepare('SELECT * FROM Ordinateur WHERE NumInventaire LIKE :NumInventaire');

// 	$req->execute(array(
// 		'NumInventaire' => $NumInventaire
// 	));

// 	$nbr=$req->rowCount();

// 	return $nbr;

// }

function debut_selection(){

	$output = '

	<!DOCTYPE html>
	<html>

	<body>
	<br> 

	<div class="global">

	<h1 class="h1_global"> SÉLECTION </h1>

	<div class="corps_global">
	<div class="div_global">
	<br>


	<input id="selectAll" type="checkbox"><label for="selectAll">&nbsp;Tout sélectionner</label> &nbsp; &nbsp; &nbsp;
	<button type="button" name="add_to_cart" id="add_to_cart" class="btn btn-success btn-xs">Ajouter au panier </button>
	<br>
	<br>
	<table border="1" class="table table-striped">

	<th>Choix</th>
	<th> N° Série</th>
	<th> Type </th>
	<th> Modèle</th>
	<th> État</th>
	<th> Statut </th>
	<th> Date de fin de garantie </th>
	<th> Lieu </th>
	<th> Centre Responsable </th>
	<th> Remarque </th>
	<th> N° Inventaire </th>
	<th> N° Immobilisation </th>

	';

	echo $output;
}

function fin_selection(){
	$output = '</table>

	<br><br>

	</div>

	</div>

	</div>

	<br>
	</body>
	</html>';

	echo $output;
}

function count_rech_numSerie($NumSerie){

	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT * FROM Ordinateur WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function rech_numSerie($NumSerie){

	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT NumSerie, Typee, ordi1.IdCR, NomCR, Modele, Etat, Statut, IdLieu, Remarque, NumInventaire, NumImmobilisation, ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie 
		FROM Ordinateur ordi1, Commande, CentreResponsable
		WHERE ordi1.NumSerie = :NumSerie
		AND ordi1.NumCommande = Commande.NumCommande
		AND ordi1.IdCR = CentreResponsable.IdCR');

	$req->execute(array(
		'NumSerie' => $NumSerie
	));

	while($donnees = $req->fetch()){
		echo'
		<div id="product_'.$donnees["NumSerie"].'">
		<tr>

		<td> <div class="checkbox">
		<label>
		<input type="checkbox" class="select_product" 
		data-product_id="'.$donnees["NumSerie"].'" 
		data-product_num="'.$donnees["NumSerie"].'" 
		data-product_type="'.$donnees["Typee"].'" 
		data-product_idcr="'.$donnees["IdCR"].'" 
		data-product_nomcr="'.$donnees["NomCR"].'" 
		data-product_modele="'.$donnees["Modele"] .'" 
		data-product_etat="'.$donnees["Etat"] .'" 
		data-product_statut="'.$donnees["Statut"] .'"
		data-product_garantie="'.$donnees["DateFinGarantie"] .'"
		data-product_lieu="'.$donnees["IdLieu"] .'"
		data-product_remarque="'.$donnees["Remarque"] .'"
		data-product_inventaire="'.$donnees["NumInventaire"] .'"
		data-product_immobilisation="'.$donnees["NumImmobilisation"] .'"
		value="">
		</td>


		<td width=120px>' . $donnees['NumSerie'] . '</td>
		<td width=120px>' . $donnees['Typee'] . '</td>
		<td width=120px>' . $donnees['Modele'] . '</td>
		<td width=120px>' . $donnees['Etat'] . '</td>
		<td width=120px>' . $donnees['Statut'] . '</td>
		<td width=120px>' . $donnees['DateFinGarantie'] . '</td>
		<td width=120px>' . $donnees['IdLieu'] . '</td>
		<td width=120px>' . $donnees['NomCR'] . '</td>
		<td width=120px>' . $donnees['Remarque'] . '</td>
		<td width=120px>' . $donnees['NumInventaire'] . '</td>
		<td width=120px>' . $donnees['NumImmobilisation'] . '</td>
		</tr>
		';
	}

}

function count_rech_idLieu($IdLieu, $Etat, $garantie, $Statut, $numInv, $numImmo){

	$bdd = dbConnect();

	$where = "";

	if($garantie=="sous garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) > DATE(NOW()) ';
	}
	if($garantie=="hors garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) < DATE(NOW()) ';
	}
	if($numInv=="non_vide"){
		$where = $where . ' AND ordi1.NumInventaire IS NULL ';
	}
	if($numImmo=="non_vide"){
		$where = $where . ' AND ordi1.NumImmobilisation IS NULL ';
	}

	$req = $bdd->prepare('
		SELECT * 
		FROM Ordinateur ordi1 
		WHERE ordi1.IdLieu = :IdLieu 
		AND ordi1.Etat LIKE :Etat 
		AND ordi1.Statut LIKE :Statut' . $where);

	$req->execute(array(
		'IdLieu' => $IdLieu,
		'Etat' => $Etat,
		'Statut' => $Statut
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function rech_idLieu($IdLieu, $Etat, $garantie, $Statut, $numInv, $numImmo){

	$bdd = dbConnect();

	$where = "";

	if($garantie=="sous garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) > DATE(NOW()) ';
	}
	if($garantie=="hors garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) < DATE(NOW()) ';
	}
	if($numInv=="non_vide"){
		$where = $where . ' AND ordi1.NumInventaire IS NULL ';
	}
	if($numImmo=="non_vide"){
		$where = $where . ' AND ordi1.NumImmobilisation IS NULL ';
	}
	$req = $bdd->prepare('
		SELECT NumSerie, Typee, ordi1.IdCR, NomCR, Modele, Etat, Statut, IdLieu, Remarque, NumInventaire, NumImmobilisation, ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie
		FROM Ordinateur ordi1, Commande co1, CentreResponsable
		WHERE ordi1.IdLieu = :IdLieu 
		AND ordi1.Etat LIKE :Etat 
		AND ordi1.Statut LIKE :Statut
		AND ordi1.IdCR = CentreResponsable.IdCR
		AND ordi1.NumCommande = co1.NumCommande' . $where);

	$req->execute(array(
		'IdLieu' => $IdLieu,
		'Etat' => $Etat,
		'Statut' => $Statut
	));

	while($donnees = $req->fetch()){
		echo'
		<div id="product_'.$donnees["NumSerie"].'">
		<tr>

		<td> <div class="checkbox">
		<label>
		<input type="checkbox" class="select_product" 
		data-product_id="'.$donnees["NumSerie"].'" 
		data-product_num="'.$donnees["NumSerie"].'" 
		data-product_type="'.$donnees["Typee"].'" 
		data-product_idcr="'.$donnees["IdCR"].'" 
		data-product_nomcr="'.$donnees["NomCR"].'" 
		data-product_modele="'.$donnees["Modele"] .'" 
		data-product_etat="'.$donnees["Etat"] .'" 
		data-product_statut="'.$donnees["Statut"] .'"
		data-product_garantie="'.$donnees["DateFinGarantie"] .'"
		data-product_lieu="'.$donnees["IdLieu"] .'"
		data-product_remarque="'.$donnees["Remarque"] .'"
		data-product_inventaire="'.$donnees["NumInventaire"] .'"
		data-product_immobilisation="'.$donnees["NumImmobilisation"] .'"
		value="">
		</td>


		<td width=120px>' . $donnees['NumSerie'] . '</td>
		<td width=120px>' . $donnees['Typee'] . '</td>
		<td width=120px>' . $donnees['Modele'] . '</td>
		<td width=120px>' . $donnees['Etat'] . '</td>
		<td width=120px>' . $donnees['Statut'] . '</td>
		<td width=120px>' . $donnees['DateFinGarantie'] . '</td>
		<td width=120px>' . $donnees['IdLieu'] . '</td>
		<td width=120px>' . $donnees['NomCR'] . '</td>
		<td width=120px>' . $donnees['Remarque'] . '</td>
		<td width=120px>' . $donnees['NumInventaire'] . '</td>
		<td width=120px>' . $donnees['NumImmobilisation'] . '</td>
		</tr>
		';
	}

}

function count_rech_numBat($NumBatiment, $Etat, $garantie, $Statut, $numInv, $numImmo){

	$bdd = dbConnect();

	$where = "";

	if($garantie=="sous garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) > DATE(NOW()) ';
	}
	if($garantie=="hors garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) < DATE(NOW()) ';
	}
	if($numInv=="non_vide"){
		$where = $where . ' AND ordi1.NumInventaire IS NULL ';
	}
	if($numImmo=="non_vide"){
		$where = $where . ' AND ordi1.NumImmobilisation IS NULL ';
	}
	$req = $bdd->prepare('
		SELECT * 
		FROM Ordinateur ordi1 
		WHERE ordi1.IdLieu IN (SELECT IdLieu FROM Lieu WHERE NumBatiment = :NumBatiment)
		AND ordi1.Etat LIKE :Etat 
		AND ordi1.Statut LIKE :Statut' . $where);

	$req->execute(array(
		'NumBatiment' => $NumBatiment,
		'Etat' => $Etat,
		'Statut' => $Statut
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function rech_numBat($NumBatiment, $Etat, $garantie, $Statut, $numInv, $numImmo){

	$bdd = dbConnect();

	$where = "";

	if($garantie=="sous garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) > DATE(NOW()) ';
	}
	if($garantie=="hors garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) < DATE(NOW()) ';
	}
	if($numInv=="non_vide"){
		$where = $where . ' AND ordi1.NumInventaire IS NULL ';
	}
	if($numImmo=="non_vide"){
		$where = $where . ' AND ordi1.NumImmobilisation IS NULL ';
	}
	$req = $bdd->prepare('
		SELECT NumSerie, Typee, ordi1.IdCR, NomCR, Modele, Etat, Statut, IdLieu, Remarque, NumInventaire, NumImmobilisation, ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie
		FROM Ordinateur ordi1, Commande co1, CentreResponsable
		WHERE ordi1.IdLieu IN (SELECT IdLieu FROM Lieu WHERE NumBatiment = :NumBatiment)
		AND ordi1.Etat LIKE :Etat 
		AND ordi1.Statut LIKE :Statut
		AND ordi1.IdCR = CentreResponsable.IdCR
		AND ordi1.NumCommande = co1.NumCommande' . $where);

	$req->execute(array(
		'NumBatiment' => $NumBatiment,
		'Etat' => $Etat,
		'Statut' => $Statut
	));

	while($donnees = $req->fetch()){
		echo'
		<div id="product_'.$donnees["NumSerie"].'">
		<tr>

		<td> <div class="checkbox">
		<label>
		<input type="checkbox" class="select_product" 
		data-product_id="'.$donnees["NumSerie"].'" 
		data-product_num="'.$donnees["NumSerie"].'" 
		data-product_type="'.$donnees["Typee"].'" 
		data-product_idcr="'.$donnees["IdCR"].'" 
		data-product_nomcr="'.$donnees["NomCR"].'" 
		data-product_modele="'.$donnees["Modele"] .'" 
		data-product_etat="'.$donnees["Etat"] .'" 
		data-product_statut="'.$donnees["Statut"] .'"
		data-product_garantie="'.$donnees["DateFinGarantie"] .'"
		data-product_lieu="'.$donnees["IdLieu"] .'"
		data-product_remarque="'.$donnees["Remarque"] .'"
		data-product_inventaire="'.$donnees["NumInventaire"] .'"
		data-product_immobilisation="'.$donnees["NumImmobilisation"] .'"
		value="">
		</td>

		<td width=120px>' . $donnees['NumSerie'] . '</td>
		<td width=120px>' . $donnees['Typee'] . '</td>
		<td width=120px>' . $donnees['Modele'] . '</td>
		<td width=120px>' . $donnees['Etat'] . '</td>
		<td width=120px>' . $donnees['Statut'] . '</td>
		<td width=120px>' . $donnees['DateFinGarantie'] . '</td>
		<td width=120px>' . $donnees['IdLieu'] . '</td>
		<td width=120px>' . $donnees['NomCR'] . '</td>
		<td width=120px>' . $donnees['Remarque'] . '</td>
		<td width=120px>' . $donnees['NumInventaire'] . '</td>
		<td width=120px>' . $donnees['NumImmobilisation'] . '</td>
		</tr>
		';
	}

}

function count_rech_reste($Etat, $garantie, $Statut, $numInv, $numImmo){

	$bdd = dbConnect();

	$where = "";

	if($garantie=="sous garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) > DATE(NOW()) ';
	}
	if($garantie=="hors garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) < DATE(NOW()) ';
	}
	if($numInv=="non_vide"){
		$where = $where . ' AND ordi1.NumInventaire IS NULL ';
	}
	if($numImmo=="non_vide"){
		$where = $where . ' AND ordi1.NumImmobilisation IS NULL ';
	}
	$req = $bdd->prepare('
		SELECT * 
		FROM Ordinateur ordi1 
		WHERE ordi1.Etat LIKE :Etat 
		AND ordi1.Statut LIKE :Statut' . $where);

	$req->execute(array(
		'Etat' => $Etat,
		'Statut' => $Statut
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function rech_reste($Etat, $garantie, $Statut, $numInv, $numImmo){

	$bdd = dbConnect();

	$where = "";

	if($garantie=="sous garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) > DATE(NOW()) ';
	}
	if($garantie=="hors garantie"){
		$where = $where . ' AND (SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) FROM Ordinateur ordi2,Commande WHERE Commande.NumCommande=ordi2.NumCommande AND ordi1.NumSerie=ordi2.NumSerie) < DATE(NOW()) ';
	}
	if($numInv=="non_vide"){
		$where = $where . ' AND ordi1.NumInventaire IS NULL ';
	}
	if($numImmo=="non_vide"){
		$where = $where . ' AND ordi1.NumImmobilisation IS NULL ';
	}
	$req = $bdd->prepare('
		SELECT NumSerie, Typee, ordi1.IdCR, NomCR, Modele, Etat, Statut, IdLieu, Remarque, NumInventaire, NumImmobilisation, ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie
		FROM Ordinateur ordi1, Commande co1, CentreResponsable
		WHERE ordi1.Etat LIKE :Etat 
		AND ordi1.Statut LIKE :Statut
		AND ordi1.IdCR = CentreResponsable.IdCR
		AND ordi1.NumCommande = co1.NumCommande' . $where);

	$req->execute(array(
		'Etat' => $Etat,
		'Statut' => $Statut
	));

	while($donnees = $req->fetch()){
		echo'
		<div id="product_'.$donnees["NumSerie"].'">
		<tr>

		<td> <div class="checkbox">
		<label>
		<input type="checkbox" class="select_product" 
		data-product_id="'.$donnees["NumSerie"].'" 
		data-product_num="'.$donnees["NumSerie"].'" 
		data-product_type="'.$donnees["Typee"].'" 
		data-product_idcr="'.$donnees["IdCR"].'" 
		data-product_nomcr="'.$donnees["NomCR"].'" 
		data-product_modele="'.$donnees["Modele"] .'" 
		data-product_etat="'.$donnees["Etat"] .'" 
		data-product_statut="'.$donnees["Statut"] .'"
		data-product_garantie="'.$donnees["DateFinGarantie"] .'"
		data-product_lieu="'.$donnees["IdLieu"] .'"
		data-product_remarque="'.$donnees["Remarque"] .'"
		data-product_inventaire="'.$donnees["NumInventaire"] .'"
		data-product_immobilisation="'.$donnees["NumImmobilisation"] .'"
		value="">
		</td>

		<td width=120px>' . $donnees['NumSerie'] . '</td>
		<td width=120px>' . $donnees['Typee'] . '</td>
		<td width=120px>' . $donnees['Modele'] . '</td>
		<td width=120px>' . $donnees['Etat'] . '</td>
		<td width=120px>' . $donnees['Statut'] . '</td>
		<td width=120px>' . $donnees['DateFinGarantie'] . '</td>
		<td width=120px>' . $donnees['IdLieu'] . '</td>
		<td width=120px>' . $donnees['NomCR'] . '</td>
		<td width=120px>' . $donnees['Remarque'] . '</td>
		<td width=120px>' . $donnees['NumInventaire'] . '</td>
		<td width=120px>' . $donnees['NumImmobilisation'] . '</td>
		</tr>
		';
	}

}

function change_CR($NumSerie, $IdCR){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET IdCR = :IdCR  WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'IdCR' => $IdCR
	));

}

function change_Lieu($NumSerie, $IdLieu){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET IdLieu = :IdLieu  WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'IdLieu' => $IdLieu
	));

}

function change_CR_Lieu($NumSerie, $IdCR, $IdLieu){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET IdLieu = :IdLieu, IdCR = :IdCR WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'IdLieu' => $IdLieu,
		'IdCR' => $IdCR
	));

}


function alr_modified($NumSerie){

	$bdd = dbConnect();
	
	$typeFiche = 'Entrée';

	$req = $bdd->prepare('SELECT * FROM Gere_Par_Hist WHERE NumSerie = :NumSerie AND dateFinGestion = DATE(NOW()) AND typeFiche != :typeFiche');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'typeFiche' => $typeFiche
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function sortir($NumSerie, $Statut, $detailSortieInventaire){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET Statut = :Statut, detailSortieInventaire = :detailSortieInventaire  WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'Statut' => $Statut,
		'detailSortieInventaire' => $detailSortieInventaire,
	));

}

function change_CR_horsFDS($NumSerie, $IdCR, $statut){
	
	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET IdCR = :IdCR, Statut=:Statut  WHERE NumSerie = :NumSerie');
	

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'IdCR' => $IdCR,
		'Statut' => $statut
	));

}

function change_Lieu_horsFDS($NumSerie, $IdLieu, $statut){
	$stat = 'Hors FDS dans inventaire UM';
	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET IdLieu = :IdLieu, Statut=:Statut WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'IdLieu' => $IdLieu,
		'Statut' => $statut
	));

}
function change_CR_Lieu_HorsFDS($NumSerie, $IdCR, $IdLieu, $statut){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET IdLieu = :IdLieu, IdCR = :IdCR, Statut=:Statut WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'IdCR' => $IdCR,
		'IdLieu' => $IdLieu,		
		'Statut' => $statut
	));

}

function connecter($nom_utilisateur, $mot_de_passe){

	$bdd = dbConnect();

	$req = $bdd->prepare('SELECT * FROM Utilisateur WHERE nom_utilisateur = :nom_utilisateur AND mot_de_passe = :mot_de_passe');

	$req->execute(array(
		'nom_utilisateur' => $nom_utilisateur,
		'mot_de_passe' => $mot_de_passe
	));

	$nbr=$req->rowCount();

	return $nbr;

}

function change_etat($NumSerie, $etat){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET etat = :etat WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'etat' => $etat
	));

}

function change_type($NumSerie, $type){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET typee = :typee WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'typee' => $type
	));

}

function change_modele($NumSerie, $modele){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET modele = :modele WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'modele' => $modele
	));

}

function change_annee($NumSerie, $nb){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET NbrAnneGarantie = :NbrAnneGarantie WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'NbrAnneGarantie' => $nb
	));

}

function change_immo_inv_rmq($NumSerie, $immo, $inve, $rmq){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET NumImmobilisation = :NumImmobilisation,  NumInventaire= :NumInventaire, Remarque= :Remarque WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'NumImmobilisation' => $immo,
		'NumInventaire' => $inve,
		'Remarque' => $rmq
	));

}

function change_inv_rmq($NumSerie, $inve, $rmq){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET NumInventaire= :NumInventaire, Remarque= :Remarque WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'NumInventaire' => $inve,
		'Remarque' => $rmq
	));

}

function change_immo_rmq($NumSerie, $immo, $rmq){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET NumImmobilisation = :NumImmobilisation,  Remarque= :Remarque WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'NumImmobilisation' => $immo,
		'Remarque' => $rmq
	));

}

function change_immo_inv($NumSerie, $immo, $inve){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET NumImmobilisation = :NumImmobilisation,  NumInventaire= :NumInventaire WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'NumImmobilisation' => $immo,
		'NumInventaire' => $inve
	));

}


function change_immo($NumSerie, $immo){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET NumImmobilisation = :NumImmobilisation WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'NumImmobilisation' => $immo
	));

}

function change_inv($NumSerie, $inve){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET  NumInventaire= :NumInventaire WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'NumInventaire' => $inve
	));

}

function change_rmq($NumSerie, $rmq){

	$bdd = dbConnect();

	$req = $bdd->prepare('UPDATE Ordinateur SET  Remarque= :Remarque WHERE NumSerie = :NumSerie');

	$req->execute(array(
		'NumSerie' => $NumSerie,
		'Remarque' => $rmq
	));

}



/*function fin_Garantie($NumSerie, $date){
    $bdd = dbConnect();
    $req= $bdd->query('SELECT ADDDATE(DateDebutGarantie,INTERVAL NbrAnneGarantie YEAR) as DateFinGarantie 
	 	FROM Ordinateur O2,Commande 
		WHERE Commande.NumCommande=O2.NumCommande AND O2.NumSerie=O1.NumSerie');
	$req -> execute ( array(
		'NumSerie' => $NumSerie,
		'NbrAnneGarantie' => $annee
	));	
}




	/*$req->execute(array(
		'IdLieu' => $IdLieu
	));

	$nbr=$req->rowCount();

	return $nbr;	
	*/



function debut_Lastselection(){

	$output = '

	
	
	<h3> Dernier(s) résultat(s) : </h3>
	<br>


	<input id="selectAll" type="checkbox"><label for="selectAll">&nbsp;Tout sélectionner</label> &nbsp; &nbsp; &nbsp;
	<button type="button" name="add_to_cart" id="add_to_cart" class="btn btn-success btn-xs">Ajouter au panier </button>
	<br>
	<br>
	<table border="1" class="table table-striped">

	<th>Choix</th>
	<th> N° Série</th>
	<th> Type </th>
	<th> Modèle</th>
	<th> État</th>
	<th> Statut </th>
	<th> Date de fin de garantie </th>
	<th> Lieu </th>
	<th> Centre Responsable </th>
	<th> Remarque </th>
	<th> N° Inventaire </th>
	<th> N° Immobilisation </th>

	';

	echo $output;
}

function printCR_FDS(){

$bdd = dbConnect();

$reponse = $bdd->query('SELECT * FROM CentreResponsable WHERE CodeCR = 1890');

while ($donnees = $reponse->fetch())
{
echo '<option value=" ' . $donnees['IdCR'] . ' "> ' . $donnees['NomCR'] . ' </option>';
}

}

function printLieu_FDS(){

$bdd = dbConnect();

$reponse = $bdd->query('SELECT * FROM Lieu WHERE NumCampus = 1');

while ($donnees = $reponse->fetch())
{
echo '<option value="' . $donnees['IdLieu'] . '"> ' . $donnees['IdLieu'] . ' </option>';
}

return $nbr;

}

function printOrdiPanneRep($Etat){

	$bdd = dbConnect();

	$reponse = $bdd->query("SELECT * FROM Ordinateur ordi, Dirige cr, Personne per WHERE ordi.idCR = cr.idCR AND cr.IdPersonne = per.IdPersonne AND ordi.Etat LIKE :Etat");

	$reponse->execute(array(
		'Etat' => $Etat
	));

	while ($donnees = $reponse->fetch())
	{
		echo " <tr>
		<td width=120px>". $donnees['IdLieu']."</td>
		<td width=120px>". $donnees['NumSerie']."</td>
		<td width=120px>". $donnees['Typee']."</td>
		<td width=120px>". $donnees['Modele']."</td>
		<td width=120px>". $donnees['Etat']."</td>
		<td width=120px>". $donnees['Statut']."</td>
		<td width=120px>". $donnees['NbrAnneGarantie']."</td>
		<td width=120px>". $donnees['Remarque']."</td>
		<td width=120px>". $donnees['email']."</td>
		<td width=120px>". $donnees['NumTelephone']."</td>
		</tr>";
	}
	
}

function panne_reparation_result(){
$dbh=dbConnect();
         
           $reponse = $dbh->query("select * from Ordinateur, Dirige, Personne where Ordinateur.IdCR=Dirige.IdCR AND Dirige.IdPersonne=Personne.IdPersonne AND Etat like'%".$_POST['choix']."%'");
           $nbre_lignes = $reponse->rowCount();
           echo "Nombre de résultats de votre recherche : " .$nbre_lignes." .";
  
             while ($donnees = $reponse->fetch())
               {
        ?>  
                   
 <tr>
 <td width=120px><?php echo $donnees['NumSerie']; ?></td>
<td width=120px> <?php echo $donnees['Typee']; ?></td>
<td width=120px><?php echo $donnees['Modele']; ?></td>
<td width=120px><?php echo $donnees['Etat']; ?></td>
<td width=120px><?php echo $donnees['Statut']; ?></td>
<td width=120px><?php echo $donnees['NbrAnneGarantie']; ?></td>
<td width=120px><?php echo $donnees['Remarque']; ?></td>
<td width=120px><?php echo $donnees['email']; ?></td>
<td width=120px><?php echo $donnees['NumTelephone']; ?></td>
</tr>
       <?php
         
        } 
     
     } 
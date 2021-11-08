<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

require_once $model_path . 'model.php';

if(isset($_POST['ajouter'])) {
	/* VERIFICATION DE L'UNICITÉ DU NUMSERIE, NUMINVENTAIRE ET NUMIMMOBILISATION */
	$nbr_serie = sameNumSerie($_POST['numserie']);

	if($nbr_serie != 0){
		header('Location: ' . $view_path . 'ajouter_ordis.php?status=serie_existe');
	}

	$numimmo = $_POST['numimmobilisation'];
	if($_POST['numimmobilisation'] == ''){ 
		$numimmo = NULL;
	}else {
		$nbr_immo = sameNumImmo($_POST['numimmobilisation']);
		if($nbr_immo != 0){
			header('Location: ' . $view_path . 'ajouter_ordis.php?status=immo_existe');
		}
	}

	$numinv = $_POST['numinventaire'];
	if($_POST['numinventaire'] == ''){ 
		$numinv = NULL;
	}else {
		$nbr_inv = sameNumInv($_POST['numinventaire']);
		if($nbr_inv != 0){
			header('Location: ' . $view_path . 'ajouter_ordis.php?status=inv_existe');
		}
	}
	/* FIN VERIFICATION */

	/* COMMANDE */
	$date = $_POST['dateDebGarantie'];
	$date_bdd = implode('-',array_reverse (explode('/',$date))); /* transforme le format de la date entrée dans le formulaire */
	$cr_com = (int)$_POST['CR_commande'];
    $numSIFAC = $_POST['numCommande'];
	if($_POST['numCommande'] == ''){ 
		$numSIFAC = NULL;
	}

	if( ($numSIFAC != NULL) && (sameSIFAC($numSIFAC, $_POST['fournisseur'], $date_bdd, $cr_com) == 0) ){ /* si la commande n'existe pas, on l'ajoute */
		addCommande($numSIFAC, $_POST['fournisseur'], $date_bdd, $cr_com);
	}else{
		if($numSIFAC==NULL){ /* si le numéro de commande SIFAC n'est pas renseigné, on ajoute la commande */
			addCommandeNull($_POST['fournisseur'], $date_bdd, $cr_com);
		}
	}
	/* FIN COMMANDE */

	/* ORDINATEUR */
	if($numSIFAC != NULL){
		$numCom = (int)getNumCommande($numSIFAC, $_POST['fournisseur'], $date_bdd, $cr_com);
	}else{
		if($numSIFAC==NULL){ 
			$numCom = (int)getNumCommandeNull($_POST['fournisseur'], $date_bdd, $cr_com);
		}
	}
	$cr_ordi = (int)$_POST['CR_ordi'];
	$nb_an_gar = (int)$_POST['nbAnneeGarantie'];
	$Etat = 'Fonctionnel';
	$Statut = 'Dans inventaire FDS';
	$dateDebutGestion = date('Y-m-j');
	$detailSortieInventaireUM = NULL;
	$Remarque = NULL;

	addOrdi($_POST['numserie'], $_POST['type'], $_POST['modele'], $numimmo, $_POST['fabricant'], $numinv, $Etat, $Statut, $detailSortieInventaireUM, $Remarque, $nb_an_gar, $dateDebutGestion, $cr_ordi, $numCom, $_POST['salle']);
	/* FIN ORDINATEUR */

	//echo "L'ordinateur a bien été ajouté !";

	$serie_ajout = sameNumSerie($_POST['numserie']);
	if($serie_ajout == 1){
		header('Location: ' . $view_path . 'ajouter_ordis.php?status=ajout_reussi');
	}
	else{
		header('Location: ' . $view_path . 'ajouter_ordis.php?status=echouer');
	}

	exit();
}

?>
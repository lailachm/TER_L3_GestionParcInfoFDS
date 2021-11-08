<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

require_once $model_path . 'model.php';

if (isset($_POST["import"])) {

	$fileName = $_FILES["file"]["tmp_name"];
	$Etat = 'Fonctionnel';
	$Statut = 'Dans inventaire FDS';
	$detailSortieInventaireUM = NULL;
	$Remarque = NULL;
	$dateDebutGestion = date('Y-m-j');

	$cpt=1;
	$verif='not ok';

	if ($_FILES["file"]["size"] > 0) {

		$file = fopen($fileName, "r");
		fgetcsv($file, 10000, ","); //lit la premiere ligne (pour rien) et permet de sauter la premiere ligne du fichier (contenant la trame)
		
		while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
		    /* VERIFICATION QU'AUCUNE INFORMATION NE MANQUE + LE LIEU EST BON */

			if($column[0]=='' || $column[1]=='' || $column[2]=='' || $column[4]=='' || $column[6]=='' || $column[7]=='' || $column[8]=='' || $column[10]=='' || $column[11]=='' || $column[12]==''){
				header('Location: ' . $view_path . 'ajouter_ordis.php?status=champ_obligatoire&cpt='.$cpt);
				exit();
			}
			if(sameLieu($column[8]) == 0){
				header('Location: ' . $view_path . 'ajouter_ordis.php?status=wrong_place&cpt='.$cpt);
				exit();
			}

			/* FIN VERIFICATION */
		    
			/* VERIFICATION DE L'UNICITÉ DU NUMSERIE, NUMINVENTAIRE ET NUMIMMOBILISATION */
			
			$nbr_serie = sameNumSerie($column[0]);

			if($nbr_serie != 0){
				header('Location: ' . $view_path . 'ajouter_ordis.php?status=serie_existe&cpt='.$cpt);
			}

			$numimmo = $column[3];
			if($column[3] == ''){ 
				$numimmo = NULL;
			}else {
				$nbr_immo = sameNumImmo($column[3]);
				if($nbr_immo != 0){
					header('Location: ' . $view_path . 'ajouter_ordis.php?status=immo_existe&cpt='.$cpt);
				}
			}

			$numinv = $column[5];
			if($column[5] == ''){
				$numinv = NULL;
			}else {
				$nbr_inv = sameNumInv($column[5]);
				if($nbr_inv != 0){
					header('Location: ' . $view_path . 'ajouter_ordis.php?status=inv_existe&cpt='.$cpt);
				}
			}
			/* FIN VERIFICATION */

			/* COMMANDE */
			$date = $column[11];
			$date_bdd = implode('-',array_reverse (explode('/',$date))); /* transforme le format de la date entrée dans le formulaire */
			$cr_com = (int)$column[12];
            $numSIFAC = $column[9];
			if($column[9] == ''){ 
				$numSIFAC = NULL;
			}

			if( ($numSIFAC != NULL) && (sameSIFAC($numSIFAC, $column[10], $date_bdd, $cr_com) == 0) ){ /* si la commande n'existe pas, on l'ajoute */
				addCommande($numSIFAC, $column[10], $date_bdd, $cr_com);
		}else{
			if($numSIFAC==NULL){ /* si le numéro de commande SIFAC n'est pas renseigné, on ajoute la commande */
				addCommandeNull($column[10], $date_bdd, $cr_com);
		}
	}
			/* FIN COMMANDE */

			/* ORDINATEUR */
			if($numSIFAC != NULL){
		        $numCom = (int)getNumCommande($numSIFAC, $column[10], $date_bdd, $cr_com);
	        }else{
		        if($numSIFAC==NULL){ 
			        $numCom = (int)getNumCommandeNull($column[10], $date_bdd, $cr_com);
		        }
	        }
			
			$nb_an_gar = (int)$column[6];
			addOrdi($column[0], $column[1], $column[2], $numimmo, $column[4], $numinv, $Etat, $Statut, $detailSortieInventaireUM, $Remarque, $nb_an_gar, $dateDebutGestion, $column[7], $numCom, $column[8]);
			/* FIN ORDINATEUR */
			$serie_ajout = sameNumSerie($column[0]);
			if($serie_ajout == 1){
				$verif = 'ok';
				$cpt=$cpt+1;
			}
			else{
				header('Location: ' . $view_path . 'ajouter_ordis.php?status=echouer&cpt='.$cpt);
			}
		}
		
	}
	if($verif=='ok'){
		header('Location: ' . $view_path . 'ajouter_ordis.php?status=ajout_reussi');
	}
	else{
		header('Location: ' . $view_path . 'ajouter_ordis.php?status=echouer&cpt='.$cpt);
	}
}


exit();

                   // $NumSerie, $Typee, $Modele, $NumImmobilisation, $Fabricant, $NumInventaire, $Etat, $Statut, $detailSortieInventaireUM, $Remarque, $NbrAnneGarantie, $dateDebutGestion, $IdCR, $NumCommande, $IdLieu
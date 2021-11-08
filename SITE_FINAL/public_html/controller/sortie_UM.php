<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

require_once $model_path . 'model.php';

if(isset($_POST['sortir'])) {

	if(!empty($_SESSION["shopping_cart"]))
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["product_statut"] != "Hors inventaire UM"){

				if(alr_modified($values["product_id"]) == 0){ 
					$statut = 'Hors inventaire UM';
					sortir($values["product_id"], $statut, $_POST['commentaire']);
					unset($_SESSION["shopping_cart"][$keys]);
					
				}else{

					header('Location: ' . $view_path . 'sortie_UM.php?status=dejamodif');
					exit();

				}

			}else{

				header('Location: ' . $view_path . 'sortie_UM.php?status=horsinv');
				exit();

			}
		}
	}else{
		header('Location: ' . $view_path . 'sortie_UM.php?status=err');
		exit();
	}

	header('Location: ' . $view_path . 'sortie_UM.php?status=reussi');
	exit();

}else{

	header('Location: ' . $view_path . 'sortie_UM.php?status=err');
	exit();

}
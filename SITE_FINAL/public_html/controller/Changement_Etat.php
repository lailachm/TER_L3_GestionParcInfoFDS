<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

require_once $model_path . 'model.php';

if(isset($_POST['modifier'])) {

    	if( empty($_POST['id'])){
		header('Location: ' . $view_path . 'Changement_Etat.php?status=err');
		exit();
	}
	
	else{
	    
	    if(!empty($_POST['id'])){
	        	
	        	if(!empty($_SESSION["shopping_cart"]))
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				     if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'Changement_Etat.php?status=horsinv');
						exit();

					}

						if(alr_modified($values["product_id"]) == 0){ 

							change_etat($values["product_id"], $_POST['id']);
							$values["product_etat"] = $_POST['id'];
							unset($_SESSION["shopping_cart"][$keys]);

						}/*else{

							header('Location: ' . $view_path . 'Changement_Etat.php?status=dejamodif');
							exit();
						}*/
				}
			}else {header('Location: ' . $view_path . 'Changement_Etat.php?status=panniervide');
							exit();}
	    }
	    
	    
	    header('Location: ' . $view_path . 'Changement_Etat.php?status=reussi');
	    exit();
	    
	    
	}
	
	
}
?>
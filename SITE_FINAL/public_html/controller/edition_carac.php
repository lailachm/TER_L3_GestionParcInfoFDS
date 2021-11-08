<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

require_once $model_path . 'model.php';

if(isset($_POST['modifier'])) {

    	if( empty($_POST['id1']) && empty($_POST['id2'])  && empty($_POST['id3']) && empty($_POST['id4'])&& empty($_POST['id5'])&& empty($_POST['id6'])){
		header('Location: ' . $view_path . 'edition_carac.php?status=err');
		exit();
	}
	
	else{
	    
	    
	    
	    
	    //type id 1 
	    if(!empty($_POST['id1'])){
	        	
	        	if(!empty($_SESSION["shopping_cart"]))
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}

						if(alr_modified($values["product_id"]) == 0){ 

							change_type($values["product_id"], $_POST['id1']);
							$values["product_type"] = $_POST['id1'];
							unset($_SESSION["shopping_cart"][$keys]);

						}else{

							header('Location: ' . $view_path . 'edition_carac.php?status=dejamodif');
							exit();
						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();}
	    } else {
	    
	    
	    //modele id 3
	    if(!empty($_POST['id3'])){
	        	
	        	if(!empty($_SESSION["shopping_cart"]))
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}

						if(alr_modified($values["product_id"]) == 0){ 

							change_modele($values["product_id"], $_POST['id3']);
							$values["product_modele"] = $_POST['id3'];
							unset($_SESSION["shopping_cart"][$keys]);

						}else{

							header('Location: ' . $view_path . 'edition_carac.php?status=dejamodif');
							exit();
						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();}
	    } 
	    
	    /////////////////
	    else{
	   
	    //annee de garantie id 6
	    if(!empty($_POST['id6'])){
	        	
	        	if(!empty($_SESSION["shopping_cart"]))
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{

						if(alr_modified($values["product_id"]) == 0){ 

							change_annee($values["product_id"], $_POST['id6']);
							unset($_SESSION["shopping_cart"][$keys]);

						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();}
	    }
	        
	        
	        
	        
	     //
	     //
	     //
	else {
	  if(!empty($_POST['id2']) && !empty($_POST['id4']) && !empty($_POST['id5'])){
	    	if(!empty($_SESSION["shopping_cart"]))
			{
	     	foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}
                 	if(alr_modified($values["product_id"]) == 0){ 

							change_immo_inv_rmq($values["product_id"], $_POST['id2'], $_POST['id4'], $_POST['id5']);
							$values["product_immobilisation"] = $_POST['id2'];
							$values["product_inventaire"] = $_POST['id4'];
							$values["product_remarque"] = $_POST['id5'];
							unset($_SESSION["shopping_cart"][$keys]);
							//header('Location: ' . $view_path . 'edition_carac.php?status=reussi');
	                      	//exit();

						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();
			}
	}
	
	
		
			
			
			
				else{
			
				if(!empty($_POST['id4']) && !empty($_POST['id5'])){
	    	if(!empty($_SESSION["shopping_cart"]))
			{
	     	foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}
                 	if(alr_modified($values["product_id"]) == 0){ 

							change_inv_rmq($values["product_id"], $_POST['id4'], $_POST['id5']);
							$values["product_inventaire"] = $_POST['id4'];
							$values["product_remarque"] = $_POST['id5'];
							unset($_SESSION["shopping_cart"][$keys]);

						}else{

							header('Location: ' . $view_path . 'edition_carac.php?status=dejamodif');
							exit();
						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();
			}
	}


	else if(!empty($_POST['id2']) && !empty($_POST['id5'])){
	    	if(!empty($_SESSION["shopping_cart"]))
			{
	     	foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}
                 	if(alr_modified($values["product_id"]) == 0){ 

							change_immo_rmq($values["product_id"], $_POST['id2'], $_POST['id5']);
							$values["product_immobilisation"] = $_POST['id2'];
							$values["product_remarque"] = $_POST['id5'];
							unset($_SESSION["shopping_cart"][$keys]);
						}else{

							header('Location: ' . $view_path . 'edition_carac.php?status=dejamodif');
							exit();
						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();
			}
	}
	
	
	
		else if(!empty($_POST['id2']) && !empty($_POST['id4']) ){
	    	if(!empty($_SESSION["shopping_cart"]))
			{
	     	foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}
                 	if(alr_modified($values["product_id"]) == 0){ 

							change_immo_inv($values["product_id"], $_POST['id2'], $_POST['id4']);
							$values["product_immobilisation"] = $_POST['id2'];
							$values["product_inventaire"] = $_POST['id4'];
							unset($_SESSION["shopping_cart"][$keys]);
						}else{

							header('Location: ' . $view_path . 'edition_carac.php?status=dejamodif');
							exit();
						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();
			}
	}
	
	
	
	
	else if(!empty($_POST['id2']) ){
	    	if(!empty($_SESSION["shopping_cart"]))
			{
	     	foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}
                 	if(alr_modified($values["product_id"]) == 0){ 

							change_immo($values["product_id"], $_POST['id2']);
							$values["product_immobilisation"] = $_POST['id2'];
							unset($_SESSION["shopping_cart"][$keys]);
						}else{

							header('Location: ' . $view_path . 'edition_carac.php?status=dejamodif');
							exit();
						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();
			}
	}
	
	
	else if(!empty($_POST['id4']) ){
	    	if(!empty($_SESSION["shopping_cart"]))
			{
	     	foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}
                 	if(alr_modified($values["product_id"]) == 0){ 

							change_inv($values["product_id"], $_POST['id4']);
							$values["product_inventaire"] = $_POST['id4'];
							unset($_SESSION["shopping_cart"][$keys]);

						}else{

							header('Location: ' . $view_path . 'edition_carac.php?status=dejamodif');
							exit();
						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();
			}
	}
	
	
	
	else if(!empty($_POST['id5'])){
	    	if(!empty($_SESSION["shopping_cart"]))
			{
	     	foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
				    if($values["product_statut"] == "Hors inventaire UM"){
				        header('Location: ' . $view_path . 'edition_carac.php?status=horsinv');
						exit();

					}
                 	if(alr_modified($values["product_id"]) == 0){ 

							change_rmq($values["product_id"], $_POST['id5']);
							$values["product_remarque"] = $_POST['id5'];
							unset($_SESSION["shopping_cart"][$keys]);
							
						}else{

							header('Location: ' . $view_path . 'edition_carac.php?status=dejamodif');
							exit();
						}
				}
			}else {header('Location: ' . $view_path . 'edition_carac.php?status=panniervide');
							exit();
			}
	}
	    }
     	}
	    }
	    }
  
	    
	    header('Location: ' . $view_path . 'edition_carac.php?status=reussi');   
	    exit();
	    
	}
	
	
}
?>
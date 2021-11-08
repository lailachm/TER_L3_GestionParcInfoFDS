<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

require_once $model_path . 'model.php';

if(isset($_POST['modifier'])) {

	if($_POST['nv_lieu'] == "" && $_POST['nv_CR_ordi'] == ""){
		header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=err');
		exit();
	}else{

		if($_POST['nv_lieu'] != "" && $_POST['nv_CR_ordi'] != ""){

			if(!empty($_SESSION["shopping_cart"]))
			{
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
					if($values["product_statut"] != "Hors inventaire UM"){

						if(alr_modified($values["product_id"]) == 0){ 
                            $stat = 'Hors FDS dans inventaire UM';

							change_CR_Lieu_HorsFDS($values["product_id"], $_POST['nv_CR_ordi'], $_POST['nv_lieu'], $stat);
							$values["product_lieu"] = $_POST['nv_lieu'];
                            $values["product_idcr"] = $_POST['nv_CR_ordi'];
                            $values["product_statut"] =$stat;
							unset($_SESSION["shopping_cart"][$keys]);

						}else{

							header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=dejamodif');
							exit();

						}
					}else{

						header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=horsinv');
						exit();

					}

				}

			}else{

				header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=err');
				exit();

			}

		}else{

			if(isset($_POST['nv_lieu']) && $_POST['nv_lieu'] != ""){

				if(!empty($_SESSION["shopping_cart"]))
				{
					foreach($_SESSION["shopping_cart"] as $keys => $values)
					{
						if($values["product_statut"] != "Hors inventaire UM"){

							if(alr_modified($values["product_id"]) == 0){ 
                                $stat = 'Hors FDS dans inventaire UM';
								change_Lieu_HorsFDS($values["product_id"], $_POST['nv_lieu'], $stat);
                                $values["product_lieu"] = $_POST['nv_lieu'];
                                $values["product_statut"] = $stat;
								unset($_SESSION["shopping_cart"][$keys]);

							}else{

								header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=dejamodif');
								exit();

							}
						}else{

							header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=horsinv');
							exit();

						}

					}

				}else{

					header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=err');
					exit();

				}
			}

			if(isset($_POST['nv_CR_ordi']) && $_POST['nv_CR_ordi'] != ""){

				if(!empty($_SESSION["shopping_cart"]))
				{
					foreach($_SESSION["shopping_cart"] as $keys => $values)
					{
						if($values["product_statut"] != "Hors inventaire UM"){

							if(alr_modified($values["product_id"]) == 0){ 
                                $stat = 'Hors FDS dans inventaire UM';

                                change_CR_Lieu_HorsFDS($values["product_id"], $_POST['nv_CR_ordi'], $_POST['nv_lieu'], $stat);
                                $values["product_lieu"] = $_POST['nv_lieu'];
                                $values["product_idcr"] = $_POST['nv_CR_ordi'];
                                $values["product_statut"] =$stat;
								unset($_SESSION["shopping_cart"][$keys]);

							}else{

								header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=dejamodif');
								exit();

							}

						}else{

							header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=horsinv');
							exit();

						}
					}
				}else{

					header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=err');
					exit();

				}
			}
		}

		header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=reussi');
		exit();
	}

}else{

	header('Location: ' . $view_path . 'sortie_invent_FDS.php?status=err');
	exit();

}
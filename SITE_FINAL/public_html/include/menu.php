<?php
$path = $_SERVER['PHP_SELF'];
$file = basename ($path);
?>

<div id="menu_div">
	<ul id="menu">
		<?php 
		if($file == 'accueil.php'){ ?>
			<a id="bouton_menu" href="accueil.php"><li id="menu_li" class="clique">Accueil</li></a>
		<?php }
		else {
			?> 
			<a id="bouton_menu" href="accueil.php"><li id="menu_li">Accueil</li></a>
			<?php
		}
		?>
		
		<?php 
		if($file == 'ajouter_ordis.php'){ ?>
			<a id="bouton_menu" href="ajouter_ordis.php"><li id="menu_li" class="clique">Ajouter des ordinateurs</li></a>
		<?php }
		else {
			?> 
			<a id="bouton_menu" href="ajouter_ordis.php"><li id="menu_li">Ajouter des ordinateurs</li></a>
			<?php
		}
		?>
		
		<?php 
		if($file == 'historique.php'  || $file == 'historique_result.php'){ ?>
			<a id="bouton_menu" href="historique.php"><li id="menu_li" class="clique">Fiches inventaire</li></a>
		<?php }
		else {
			?> 
			<a id="bouton_menu" href="historique.php"><li id="menu_li">Fiches inventaire</li></a>
			<?php
		}
		?>
		
		<?php 
		if($file == 'renouveler_ordis.php' OR $file == 'renouv_Ord_date.php'){ ?>
			<a id="bouton_menu" href="renouveler_ordis.php"><li id="menu_li" class="clique">Ordinateurs à renouveler</li></a>
		<?php }
		else {
			?> 
			<a id="bouton_menu" href="renouveler_ordis.php"><li id="menu_li">Ordinateurs à renouveler</li></a>
			<?php
		}
		?>
		
		<?php 
		if($file == 'panne_reparation_ordis.php' || $file == 'panne_reparation_result.php' ){ ?>
			<a id="bouton_menu" href="panne_reparation_ordis.php"><li id="menu_li" class="clique">Ordinateurs en panne et en réparation</li></a>
		<?php }
		else {
			?> 
			<a id="bouton_menu" href="panne_reparation_ordis.php"><li id="menu_li">Ordinateurs en panne et en réparation</li></a>
			<?php
		}
		?>
		
		
		<!-- *************************************************************************************************************************** -->

		<ul id="menu_2">
			<li id="titre_menu_2">Actions dépendantes du panier</li>
			<?php 
			if($file == 'modif_inventaire.php'){ ?>
				<a id="bouton_menu_2" href="modif_inventaire.php"><li id="menu_li_2" class="clique_2">Modification inventaire</li></a>
			<?php }
			else {
				?> 
				<a id="bouton_menu_2" href="modif_inventaire.php"><li id="menu_li_2">Modification inventaire</li></a>
				<?php
			}
			?>

			<?php 
			if($file == 'Changement_Etat.php'){ ?>
				<a id="bouton_menu_2" href="Changement_Etat.php"><li id="menu_li_2" class="clique_2">Changement état</li></a>
			<?php }
			else {
				?> 
				<a id="bouton_menu_2" href="Changement_Etat.php"><li id="menu_li_2">Changement état</li></a>
				<?php
			}
			?>

			<?php 
			if($file == 'sortie_invent_FDS.php'){ ?>
				<a id="bouton_menu_2" href="sortie_invent_FDS.php"><li id="menu_li_2" class="clique_2">Sortie FDS</li></a>
			<?php }
			else {
				?> 
				<a id="bouton_menu_2" href="sortie_invent_FDS.php"><li id="menu_li_2">Sortie FDS</li></a>
				<?php
			}
			?>

			<?php 
			if($file == 'sortie_UM.php'){ ?>
				<a id="bouton_menu_2" href="sortie_UM.php"><li id="menu_li_2" class="clique_2">Sortie UM</li></a>
			<?php }
			else {
				?> 
				<a id="bouton_menu_2" href="sortie_UM.php"><li id="menu_li_2">Sortie UM</li></a>
				<?php
			}
			?>

			<?php 
			if($file == 'edition_carac.php'){ ?>
				<a id="bouton_menu_2" href="edition_carac.php"><li id="menu_li_2" class="clique_2">Édition caractéristiques</li></a>
			<?php }
			else {
				?> 
				<a id="bouton_menu_2" href="edition_carac.php"><li id="menu_li_2">Édition caractéristiques</li></a>
				<?php
			}
			?>

			<li id="bttn_deco"><a <?php echo 'href="' . $controller_path . 'deconnexion.php' . '"';?>>Déconnexion</a></li>
		</ul>
		
		
		
	</ul>
	<!-- <a href="#"> Haut de page </a> -->
</div>


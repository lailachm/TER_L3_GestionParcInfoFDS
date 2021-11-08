<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

if (!isset($_SESSION['username'])) {
	header('Location: ../index.php');
}
else {
        $now = time(); // Checking the time now when home page starts.

        if ($now > $_SESSION['expire']) {
        	session_destroy();
        	header('Location: ../index.php');
        }
    }
?>

<!DOCTYPE html>
<html>

<?php include $include_path . 'header.php' ?>

<body>

  

  <br>
  
  <?php include $include_path . 'menu.php' ?>

  <div class="global">
    
  

    <h1 class="h1_global"> AJOUTER DES ORDINATEURS </h1>
    
    <div class="corps_global">
        
      <!-- MESSAGES D'ALERTE -->

      <?php if (isset($_GET['status']) && $_GET['status'] == "ajout_reussi") : ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          Ajout réussi !
        </div>
      <?php endif ?>
      <?php if (isset($_GET['status']) && $_GET['status'] == "echouer") : ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          L'ajout a échoué.&nbsp;
          <?php if (isset($_GET['cpt'])) : ?>
          L'ajout s'est arrêté à la ligne : <?php echo $_GET['cpt']; ?>
          <?php endif ?>
        </div>
      <?php endif ?>
      <?php if (isset($_GET['status']) && $_GET['status'] == "serie_existe") : ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          L'ajout a échoué : le n° de série existe déjà.&nbsp;
          <?php if (isset($_GET['cpt'])) : ?>
          L'ajout s'est arrêté à la ligne : <?php echo $_GET['cpt']; ?>
          <?php endif ?>
        </div>
      <?php endif ?>
      <?php if (isset($_GET['status']) && $_GET['status'] == "immo_existe") : ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          L'ajout a échoué : le n° d'immobilisation existe déjà.&nbsp;
          <?php if (isset($_GET['cpt'])) : ?>
          L'ajout s'est arrêté à la ligne : <?php echo $_GET['cpt']; ?>
          <?php endif ?>
        </div>
      <?php endif ?>
      <?php if (isset($_GET['status']) && $_GET['status'] == "inv_existe") : ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          L'ajout a échoué : le n° d'inventaire existe déjà. &nbsp;
          <?php if (isset($_GET['cpt'])) : ?>
          L'ajout s'est arrêté à la ligne : <?php echo $_GET['cpt']; ?>
          <?php endif ?>
        </div>
      <?php endif ?>
      <?php if (isset($_GET['status']) && $_GET['status'] == "champ_obligatoire") : ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          L'ajout a échoué : un champ obligatoire n'a pas été rempli. &nbsp;
          <?php if (isset($_GET['cpt'])) : ?>
          L'ajout s'est arrêté à la ligne : <?php echo $_GET['cpt']; ?>
          <?php endif ?>
        </div>
      <?php endif ?>
      <?php if (isset($_GET['status']) && $_GET['status'] == "wrong_place") : ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          L'ajout a échoué : le lieu entré n'apparaît pas dans la base de données. &nbsp;
          <?php if (isset($_GET['cpt'])) : ?>
          L'ajout s'est arrêté à la ligne : <?php echo $_GET['cpt']; ?>
          <?php endif ?>
        </div>
      <?php endif ?>

      <!-- FIN MESSAGES D'ALERTE -->

      <div class="div_global">
        <h2 class="h2_global">Ajouter des ordinateurs via un tableur</h2>

        <form enctype="multipart/form-data" method="post" <?php echo 'action="' . $controller_path . 'ajouter_ordis_csv.php' . '"';?> >
          <label id="label_inventaire">Fichier &nbsp;</label>
          <input type="file" name="file" id="file" accept=".csv">
          <button type="submit" name ="import"> Importer </button>
        </form>
        <br>

        <label id="label_inventaire"> <a href="download/trame_ajout.csv" download> Télécharger le tableur avec la trame incluse</a> </label>
        <br>
        <br>
        N.B. : La première ligne du fichier CSV est destinée à la trame. Il faut donc impérativement entrer les informations des ordinateurs dès la deuxième ligne.
        <br>
        <br>
    </div>

   <div class="div_global">
      <h2 class="h2_global">Ajouter un ordinateur manuellement</h2>
      <form method="post"  <?php echo 'action="' . $controller_path . 'ajouter_ordis.php' . '"';?> >
        <label id="label_inventaire">Commande passée par <span style="color: red;">*</span> :</label>
        <select name="CR_commande" size="1">
          <?php require_once $model_path . 'model.php';
          printCR(); ?>
        </select>

        <label id="label_inventaire">N° Série <span style="color: red;">*</span> :</label>
        <input type="text" name="numserie" placeholder="ex : 4RT5YU"  required>


        <label id="label_inventaire">Type <span style="color: red;">*</span> :</label>
        <input type="text" name="type" placeholder="ex : Workstation" required>
        <br>
        <br>


        <label id="label_inventaire">Fabricant <span style="color: red;">*</span> :</label>
        <input type="text" name="fabricant" placeholder="ex : Dell" required>

        <label id="label_inventaire">Modèle <span style="color: red;">*</span> :</label>
        <input type="text" name="modele" placeholder="ex : Optiplex 7440 AIO" required>


        <label id="label_inventaire">Nombre d'années de garantie <span style="color: red;">*</span> :</label>
        <input type="number" name="nbAnneeGarantie" required>
        <br>
        <br>


        <label id="label_inventaire">N° Commande SIFAC :</label>
        <input type="text" name="numCommande">

        <label id="label_inventaire">Fournisseur <span style="color: red;">*</span> :</label>
        <input type="text" name="fournisseur" placeholder="ex : Dell" required>
        <br>
        <br>


        <label id="label_inventaire">Date de début de garantie (=date d'expédition) <span style="color: red;">*</span> :</label>
        <input type="date" name="dateDebGarantie" placeholder="ex : 05/07/2016" required>
        <br>
        <br>


        <label id="label_inventaire">Centre responsable de l'ordinateur <span style="color: red;">*</span> :</label>
        <select name="CR_ordi" size="1">
          <?php require_once $model_path . 'model.php';
          printCR_FDS(); ?>
        </select>

        <label id="label_inventaire">Salle <span style="color: red;">*</span> :</label>
        <select name="salle" size="1">
          <?php require_once $model_path . 'model.php';
          printLieu_FDS(); ?>
        </select>

        <label id="label_inventaire">N° Inventaire :</label>
        <input type="text" name="numinventaire">
        <br>
        <br>

        <label id="label_inventaire">N° Immobilisation :</label>
        <input type="text" name="numimmobilisation">
        <br>
        <br>

        <button type="submit" name ="ajouter">Ajouter</button>
      </form>
      <br>
      <span style="color: red;">* OBLIGATOIRE</span>
      <br>
      <br>

    </div>

<?php include $include_path . 'footer.php' ?>
  </div>

</div>


<br>

</body>
</html>

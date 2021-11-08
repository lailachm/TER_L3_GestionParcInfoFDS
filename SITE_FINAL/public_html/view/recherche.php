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

    <h1 class="h1_global"> RECHERCHE </h1>

    <div class="corps_global">

    <!-- MESSAGES D'ALERTE -->

      <?php if (isset($_GET['status']) && $_GET['status'] == "vide") : ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          Aucun résultat ne correspond à votre recherche.
        </div>
      <?php endif ?>

      <!-- FIN MESSAGES D'ALERTE -->

     <div class="div_global">

       <center><div id="msg_recherche"> <i><b>[Ne remplissez que ce qui est nécessaire à votre recherche]</b></i></div></center>
       <br>
       <br>
       <br>

       <form name="recherche" method="post" action="selection.php" >

        <label id="label_recherche" for="name">Numéro de série :</label>
        <input placeholder="ex : 8D9VJX2" type="text" id="name" name="NumSerie" size="10">

        <label id="label_recherche" for="name">Numéro du Batiment :</label>
        <select id="bat" name="numBat" size="1">
          <option value=""></option>
          <?php require_once $model_path . 'model.php';
          printBatiment(); ?>
        </select>

        <label id="label_recherche" for="name">Lieu :</label>
        <select id="lieu" name="IdLieu" size="1">
          <option value=""></option>
          <?php require_once $model_path . 'model.php';
          printLieu(); ?>
        </select>

        <script type="text/javascript" charset="utf-8">
         $(function () {
          $("#lieu").chained("#bat");
        });
      </script>
        <!--  <input placeholder="ex : 36" type="text" id="name" name="NumBatiment" size="10"> -->
        <!-- <a href="voir_selection.php">Voir Selection</a> -->

        <label id="label_recherche" for="name">Etat :</label>
        <select class="choix" name="etat">
          <option value="%"></option>
          <option value="En panne">En panne </option>
          <option value="Fonctionnel">Fonctionnel</option>
          <option value="En reparation">En réparation</option>
        </select>

        
        <label id="label_recherche" for="name">Garantie :</label>
        <select class="choixG" name="garantie">
          <option value=""></option>
          <option value="sous garantie"> Sous garantie</option>
          <option value="hors garantie">Hors garantie</option>
        </select>
        <br>
        <br>
        <br>


        <label id="label_recherche" for="name">Statut :</label>
        <select class="choixS" name="statut">
          <option value="%"></option>
          <option value="Dans inventaire FDS"> Dans inventaire FDS</option>
          <option value="Hors FDS dans inventaire UM">Hors FDS dans inventaire UM</option>
          <option value="Hors inventaire UM">Hors inventaire UM</option>
        </select>

        <a id="select_recherche">
          <input type="checkbox" name="sans_num_inv"> 
          <label>Ordinateur sans n° inventaire </label>
        </a>

        <a id="select_recherche">
          <input type="checkbox" name="sans_num_immo"> 
          <label>Ordinateur sans n° d'immobilisation </label>
        </a>
        <br>
        <br>
        <br>


        <center> <input name = "submit" type="submit" value="Rechercher"> </center>
        <br>

      </form>
   <?php
      //debut_Lastselection();
     // if (empty($_SESSION['lastNumSerie']) && empty($_SESSION['lastIdLieu']) && empty($_SESSION['lastNumBat']) && empty($_SESSION['lastEtat']) && empty($_SESSION['lastGarantie']) && empty( $_SESSION['lastStatut']) && empty($_SESSION['lastNumInv']) && empty($_SESSION['lastNumImmo']))
     // {
     //    echo' Vide ' ;
     // }  
      
    //  if (!empty($_SESSION['lastNumSerie'])){
        
       // rech_numSerieLS($_SESSION['lastNumSerie']); 
        // unset($_SESSION['lastNumSerie']);
     //exit();
     // }
   
    
      //if(!empty($_SESSION['lastIdLieu'])){
    //   
        
       // rech_idLieuLS($_SESSION['lastIdLieu']);
      //  exit();
     // }
      
     //
      //  if(!empty($_SESSION['lastNumBat'])){
      //    rech_numBatLS($_SESSION['lastNumBat']);
      ////    exit();
      //  }

        //if(!empty($_SESSION['lastEtat'])){
       //   rech_EtatLS($_SESSION['lastEtat']);
       //  exit();
       // }

     

      //  if(isset($_SESSION['lastGarantie']) || isset($_SESSION['lastStatut']))
      //  {
         
       //   rech_resteLS($_SESSION['lastGarantie'], $_SESSION['lastStatut'], $_SESSION['lastNumInv'], $_SESSION['lastNumImmo']);
         
      //    
      //  }
        
  
        //fin_selection(); 

//?>

    </div>
  </div>
</div>
<br>
</body>
</html>
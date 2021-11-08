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
require_once $model_path . 'model.php';
include $include_path . 'header.php' ;
include $include_path . 'menu.php';





if (isset($_POST['submit'])) 
{
  if (empty($_POST['NumSerie']) && empty($_POST['IdLieu']) && empty($_POST['numBat']) && empty($_POST['etat']) && empty($_POST['garantie']) && empty($_POST['statut']) && empty($_POST['sans_num_inv']) && empty($_POST['sans_num_immo']))
  {
    echo '<script language="Javascript"> document.location.replace("' . $view_path . 'recherche.php?status=vide"); </script>';
    exit();
  }            
  else
  { 
    $numInv = "non_vide";
    $numImmo = "non_vide";

    if(empty($_POST['sans_num_inv'])){
      $numInv = "vide";
    }
    if(empty($_POST['sans_num_immo'])){
      $numImmo = "vide";
    }
$_SESSION['lastNumSerie'] = $_POST['NumSerie'] ;
      $_SESSION['lastIdLieu'] = $_POST['IdLieu'] ;
      $_SESSION['lastEtat'] = $_POST['etat'] ;
      $_SESSION['lastGarantie'] = $_POST['garantie'];
      $_SESSION['lastStatut'] =$_POST['statut'];
      $_SESSION['lastNumBat']= $_POST['numBat'];
      $_SESSION['lastNumImmo'] = $numImmo;
      $_SESSION['lastNumInv'] = $numInv;

    if(isset($_POST['NumSerie']) && $_POST['NumSerie']!="")
    {
      if(count_rech_numSerie($_POST['NumSerie']) == 0) 
      { 
        echo '<script language="Javascript"> document.location.replace("' . $view_path . 'recherche.php?status=vide"); </script>';
        exit(); 
      }
      else
      { 
        debut_selection();
        rech_numSerie($_POST['NumSerie']);
        fin_selection(); 
      }
    }
    else
    {
      if(isset($_POST['IdLieu']) && $_POST['IdLieu']!="")
      {
        if(count_rech_idLieu($_POST['IdLieu'], $_POST['etat'], $_POST['garantie'], $_POST['statut'], $numInv, $numImmo) == 0) 
        { 
          echo '<script language="Javascript"> document.location.replace("' . $view_path . 'recherche.php?status=vide"); </script>';
          exit(); 
        }
        else{ 
          debut_selection();
          rech_idLieu($_POST['IdLieu'], $_POST['etat'], $_POST['garantie'], $_POST['statut'], $numInv, $numImmo);
          fin_selection();
        }
      }
      else
      {
        if(isset($_POST['numBat']) && $_POST['numBat']!="")
        {
          if(count_rech_numBat($_POST['numBat'], $_POST['etat'], $_POST['garantie'], $_POST['statut'], $numInv, $numImmo) == 0) { 
           echo '<script language="Javascript"> document.location.replace("' . $view_path . 'recherche.php?status=vide"); </script>';
            exit(); 
          }
          else{ 
            debut_selection();
            rech_numBat($_POST['numBat'], $_POST['etat'], $_POST['garantie'], $_POST['statut'], $numInv, $numImmo);
            fin_selection();
          }
        }
        else
        {
          if(count_rech_reste($_POST['etat'], $_POST['garantie'], $_POST['statut'], $numInv, $numImmo) == 0) { 
            echo '<script language="Javascript"> document.location.replace("' . $view_path . 'recherche.php?status=vide"); </script>';
            exit(); 
          }
          else{ 
            debut_selection();
            rech_reste($_POST['etat'], $_POST['garantie'], $_POST['statut'], $numInv, $numImmo);
            fin_selection();
          }

        }
      }
    }
  }
}
else
{
  echo '<script language="Javascript"> document.location.replace("' . $view_path . 'recherche.php?status=vide"); </script>';
  exit();
}


?>
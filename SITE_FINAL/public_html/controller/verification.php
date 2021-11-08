<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

require_once $model_path . 'model.php';


if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = htmlspecialchars($_POST['username']); 
    $password = htmlspecialchars($_POST['password']);
    
    if($username !== "" && $password !== "")
    {

        $count = connecter($username, $password);

        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['username'] = $username;
           $_SESSION['start'] = time();
           $_SESSION['expire'] = $_SESSION['start'] + (4 * 60 * 60);//la session est active 4 heures

           header('Location: ' . $view_path . 'accueil.php');
       }
       else
       {
           header('Location: ../index.php?erreur=1'); // utilisateur ou mot de passe incorrect
       }

   }
   else
   {
       header('Location: ../index.php?erreur=2'); // utilisateur ou mot de passe vide
   }
}
else
{
   header('Location: ../index.php');
}

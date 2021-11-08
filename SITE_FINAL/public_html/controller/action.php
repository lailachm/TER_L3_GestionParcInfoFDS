<?php

//action.php


session_start();

if(isset($_POST["action"]))
{
 if($_POST["action"] == "add")
 {
  $product_id = $_POST["product_id"];
  $product_num = $_POST["product_num"];
  $product_type = $_POST["product_type"];
  $product_modele = $_POST["product_modele"];
  $product_etat = $_POST["product_etat"];
  $product_statut = $_POST["product_statut"];
  $product_garantie = $_POST["product_garantie"];
  $product_lieu = $_POST["product_lieu"];
  $product_idcr = $_POST["product_idcr"];
  $product_nomcr = $_POST["product_nomcr"];
  $product_remarque = $_POST["product_remarque"];
  $product_inventaire = $_POST["product_inventaire"];
  $product_immobilisation = $_POST["product_immobilisation"];
  for($count = 0; $count < count($product_id); $count++)
  {
   $cart_product_id = array_keys($_SESSION["shopping_cart"]);
   if(in_array($product_id[$count], $cart_product_id))
   {
    // $_SESSION["shopping_cart"][$product_id[$count]]['product_quantity']++;
   }
   else
   {
    $item_array = array(
     'product_id'                  =>      $product_id[$count],  
     'product_num'                 =>      $product_num[$count],
     'product_type'                =>      $product_type[$count],
     'product_modele'              =>      $product_modele[$count],
     'product_etat'                =>      $product_etat[$count],
     'product_statut'              =>      $product_statut[$count],
     'product_garantie'            =>      $product_garantie[$count],
     'product_lieu'                =>      $product_lieu[$count],
     'product_idcr'                =>      $product_idcr[$count],
     'product_nomcr'               =>      $product_nomcr[$count],
     'product_remarque'            =>      $product_remarque[$count],
     'product_inventaire'          =>      $product_inventaire[$count],
     'product_immobilisation'      =>      $product_immobilisation[$count],

   );

    $_SESSION["shopping_cart"][$product_num[$count]] = $item_array;

    
  }
  header("Location:../view/panier.php");
}

}

if($_POST["action"] == 'remove')
{
  foreach($_SESSION["shopping_cart"] as $keys => $values)
  {
   if($values["product_id"] == $_POST["product_id"])
   {
    unset($_SESSION["shopping_cart"][$keys]);
  }
}
}
if($_POST["action"] == 'empty')
{
  unset($_SESSION["shopping_cart"]);
}
}

?>
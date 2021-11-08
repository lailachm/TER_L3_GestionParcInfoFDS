<?php

//fetch_cart.php

session_start();

$total_price = 0;
$total_item = 0;

$output = '
<div class="table-responsive" id="order_table">
<table class="table table-striped">
<thead>
<tr>
<table border="1">

<th> N° Série</th>
<th> Type </th>
<th> Modèle</th>
<th> État</th>
<th> Statut </th>
<th> Date de fin de garantie </th>
<th> Lieu </th>
<th> Centre Responsable </th>
<th> Remarque </th>
<th> N° Inventaire </th>
<th> N° Immobilisation </th>
<th> </th>
</tr>
</thead>
';
$total = 0;
if(!empty($_SESSION["shopping_cart"]))
{
 foreach($_SESSION["shopping_cart"] as $keys => $values)
 {
     $total += 1;
  $output .= '
  <tr>
  <td>'.$values["product_num"].'</td>
  <td>'.$values["product_type"].'</td>
  <td>'.$values["product_modele"].'</td> 
  <td>'.$values["product_etat"].'</td>
  <td>'.$values["product_statut"].'</td>
  <td>'.$values["product_garantie"].'</td>
  <td>'.$values["product_lieu"].'</td>
  <td>'.$values["product_nomcr"].'</td>
  <td>'.$values["product_remarque"].'</td>
  <td>'.$values["product_inventaire"].'</td>
  <td>'.$values["product_immobilisation"].'</td>
  
  <td><button name="delete" class="btn btn-danger btn-xs delete" id="'. $values["product_id"].'">Retirer</button></td>
  </tr>
  ';
  $total_price = 0;
  //$total_item = $total_item + 1;
}

}
else
{
 $output .= '
 <tr>
 Le panier est vide.
 
 </tr>
 ';
}

$output .= '</table></table></div>';

echo $output;
$_SESSION['totalPanier'] = $total; 
echo '  Il y a '. $_SESSION['totalPanier'].' ordinateur(s) sélectionné(s). ';


?>
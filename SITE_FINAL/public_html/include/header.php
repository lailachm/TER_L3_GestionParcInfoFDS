<script type="text/javascript">
function noBack(){window.history.forward()}
noBack();
window.onload=noBack;
window.onpageshow=function(evt){if(evt.persisted)noBack()}
window.onunload=function(){void(0)}


</script> 
<?php
ini_set('session.gc-maxlifetime', 3);

error_reporting(0);

if (session_status() == PHP_SESSION_NONE) {
    session_start();

}




include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';
$totalP = $_SESSION['totalPanier'];
if ($totalP == NULL){
    $totalP = 0;
}
require_once $model_path . 'model.php';
dbConnect();
?>

<div id="header">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo $css_path . 'style.css'; ?>"/> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="https://www.appelsiini.net/download/jquery.chained.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.chained.js" type="text/javascript" charset="utf-8"></script>
		
	<script src="<?php echo $js_path . 'main.js'; ?>"></script>
	<title>Gestion du Parc Informatique de la FDS</title>
</head>

<header>
	
	<img class="logo" src="<?php echo $image_path . 'logo.png'; ?>"  alt="Logo UM">
	<a href="panier.php" class="bttn_panier">Panier [<?php echo $totalP ?>]</a>
	<a href="recherche.php" class="bttn_recherche">Rechercher</a>
</header>
</div>

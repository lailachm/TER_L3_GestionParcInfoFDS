<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/path.php';

require_once $model_path . 'model.php';

if(isset($_POST['date_Renouv'])) {
$date = $_POST['date_Renouv'];

header('Location: ' . $view_path . 'renouv_Ord_date.php?date='. $date );
		
} 
if(empty($_POST['date_Renouv'])){
header('Location: ' . $view_path . 'renouveler_ordis.php' );


}

?>
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

		<h1 class="h1_global"> ORDINATEURS À RENOUVELLER </h1>

		<div class="corps_global">
			<div class="div_global">
            
				<h2 class="h2_global"></h2>

               <label for="start">Date de renouvellement : </label>



                    <form method="POST"  <?php echo 'action="' . $controller_path . 'ordi_Renouv.php' . '"';?> >
                <input type="date" id="ordiRenouv" name="date_Renouv" min="2000-01-01" max="2100-12-31"> 
              
                    <input type="submit" value="Rechercher" name="ordiRenouv" type="button" action="OrdiRenouvDate.php">
                   </form>
                  

</h2>



                <table border='1'>
                <thead>
             
                                 <th> Localisation</th>
                                   <th> n° Série</th>
                                   <th> Type </th>
                                   <th> Model</th>
                                   <th> Etat</th>
                                   <th> Date de début de garantie </th>
                                   <th> Date de fin de garantie </th>
                                   <th> Durée de garantie </th>
                                   </thead>
				    
				    		     

<?php 
require_once $model_path . 'model.php';
$date = $_GET['date'];

setlocale(LC_TIME,'fr_FR','french','French_France.1252','fr_FR.ISO8859-1','fra');

$dateF= strftime("%m / %d / %y", strtotime($date));
echo "Ordinateur dont la garantie se termine avant le " .$dateF; 

OrdiRenouvDate($date);
?>
</table>
</br> </br>


		</div>
        <?php include $include_path . 'footer.php' ?>
	</div>
     
	<br>
</body>
</html>
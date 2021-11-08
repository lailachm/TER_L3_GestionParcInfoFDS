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
	    

		<h1 class="h1_global"> ORDINATEURS EN PANNE / EN REPARATION</h1>

		<div class="corps_global">
		    
			<div class="div_global">
				<h2 class="h2_global">Ordinateurs en panne / en réparation</h2>
	<br>
	
		
	          <form method="post"  action=panne_reparation_result.php >
	           	    
	           	    <label id="label_recherche" for="name">Etat :</label>
      
     
      
       <select class="choix" name="choix">
          <option value="%"></option>
          <option value="En panne">En panne </option>
          <option value="En reparation">En réparation</option>  
          <option value="En panne' OR Etat like 'En reparation">En panne/En réparation</option>
        </select>

					<button type="submit" name ="modifier">Valider</button>
				</form>



</br>
</br>

		</div>
		
		</div>

	</div>

</body>

</html>
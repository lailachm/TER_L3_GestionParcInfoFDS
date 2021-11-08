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
				<h2 class="h2_global">
				    <label for="start">Date de renouvellement : </label>


                    <form method="POST"  <?php echo 'action="' . $controller_path . 'ordi_Renouv.php' . '"';?> >
                <input type="date" id="ordiRenouv" name="date_Renouv" min="2000-01-01" max="2100-12-31"> 
              
                    <input type="submit" value="Rechercher" name="ordiRenouv" type="button" action="OrdiRenouvDate.php">
                   </form>
                    </br></br>



                    </br></br>
				       </h2>
			        <table>
                        <thead>
                         <tr>
                             <th> Localisation</th>
                            <th> n° Série</th>
                            <th> Type </th>
                            <th> Model</th>
                            <th> Etat</th>
                            <th> Date de début de garantie </th>
                            <th> Date de fin de garantie </th>
                            <th> Durée de garantie </th>
                            
                        </tr>
                        </thead>
                        <?php require_once $model_path . 'model.php';
                    ordiRenouv();
                   
                     ?>
                
                
                </table>
				      
				    </br> </br>
                    
          
        
				    
				

			</div>

			

			<?php include $include_path . 'footer.php' ?>
		</div>

	</div>

	<br>
</body>
</html>
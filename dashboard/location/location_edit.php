<?php

include '../include/framework.php';
include '../include/header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Beheer | Locaties</title>
	<?php include '../include/css.php'; ?>
</head>
<body>
        <?php include '../include/navbar.php'; ?>
    
<!-- Navigational tabs -->
        <section id="dashboard-content" class="container-fluid">
            <h1> Locaties wijzigen</h1>

            
<!-- content of the tabs -->
<?php
		$string = ("SELECT * FROM location WHERE name=" . $name);
		$query = GetDatabaseConnection()->prepare($string);
		$query->execute();
		if ($row = $query->fetch()) {
			$name = $row ["name"];
			$addres = $row ["address"];
			$postal_code = $row ["postal_code"];
			$main_number = $row ["main_number"];
		}		
?>
        <form method="post" action="location_main.php">
        	<div class="form-group">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Plaats" name="name" value=" <?= $name ?>">
                    </div>
		</div>	
                <div class="form-group">
                    <div class="row">
			<div class="col">
				<input type="text" class="form-control" placeholder="Adres" name="address"value=" <?= $address ?>">
			</div>
			<div class="col">
				<input type="text" class="form-control" placeholder="Postcode" name="postal_code"value=" <?= $postal_code ?>">
			</div>
                    </div>
                </div>
		<div class="form-group">
                    <div class="col">
                            <input type="text" class="form-control" placeholder="Hoofdnummer" name="main_number"value=" <?= $main_number ?>">
                    </div>
		</div>	            
<!--		<div class="form-group">
                    <div class="col">
                            <input type="text" class="form-control" placeholder="Intern-nummer" name="Inter-nummer">
                    </div>
		</div>	    -->
		<div class="form-group">
			<div class="col">
                            <input type="submit" class="btn btn-primary" name="submit" value="wijzigingen opslaan">
			</div>
                </div>
        </form>
 

         </div>
	</section> 

        
<?php 
if (isset($_POST["submit"])){
	$sql = "INSERT INTO location (layout_id, name, address, postal_code, main_number) VALUES (?,?,?,?,?)";
	$stmt = GetDatabaseConnection()->prepare($sql);
	$stmt->execute(array("1", $_POST["Plaats"], $_POST["Adres"], $_POST["Postcode"], $_POST["Hoofdnummer"]));
 
}
?>   
    
    
    
    	<?php include '../include/footer.php'; ?>
</body>
</html>
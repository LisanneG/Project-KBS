<?php
session_start();
include '../include/framework.php';

if(!isset($_SESSION["email"])){
	header("Location: login.php"); //Redirecting to login.php
	exit();
}

if (isset($_POST["logout"])) {
	session_destroy(); //Removing the login session
        
	header("Location: login.php"); //Redirecting to login.php
	exit();
}
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
            <h1> Locaties </h1>
		<nav class="nav nav-tabs" id="loctab" role="tablist">
			<?php if(CheckIfUserHasRight($_SESSION["admin"], "Aanmaken locatie", $_SESSION["user_id"])){ ?>
				<a class="nav-item nav-link active" id="nav-add" data-toggle="tab" href="#nav-toevoegen" role="tab" aria-controls="nav-toevoegen" aria-selected="true">Toevoegen</a>
			<?php } ?>
			<?php if(CheckIfUserHasRight($_SESSION["admin"], "Bewerken locatie", $_SESSION["user_id"])){ ?>
				<a class="nav-item nav-link" id="nav-wijzigen-tab" data-toggle="tab" href="#nav-wijzigen" role="tab" aria-controls="nav-wijzigen" aria-selected="false">Wijzigen</a>
			<?php } ?>
		</nav>
<!-- content of the tabs -->
<div class="tab-content" id="nav-tabContent">
             
 <!-- content of the tab 1 -->
        <div class="tab-pane fade show active" id="nav-toevoegen" role="tabpanel" aria-labelledby="nav-toevoegen-tab">
 	<h3>Locatie toevoegen</h3>
        <form method="post" action="location_add.php">
        	<div class="form-group">
                    <div class="col">
                            <input type="text" class="form-control" placeholder="Plaats" name="Plaats">
                    </div>
		</div>	
                <div class="form-group">
                    <div class="row">
			<div class="col">
				<input type="text" class="form-control" placeholder="Adres" name="Adres">
			</div>
			<div class="col">
				<input type="text" class="form-control" placeholder="Postcode" name="Postcode">
			</div>
                    </div>
                </div>
		<div class="form-group">
                    <div class="col">
                            <input type="text" class="form-control" placeholder="Hoofdnummer" name="Hoofdnummer">
                    </div>
		</div>	            
<!--		<div class="form-group">
                    <div class="col">
                            <input type="text" class="form-control" placeholder="Intern-nummer" name="Inter-nummer">
                    </div>
		</div>	    -->
		<div class="form-group">
			<div class="col">
                            <input type="submit" class="btn btn-primary" name="submit" value="Toevoegen">
			</div>
                </div>
        </form>
        </div>
 
<!-- content of the tab 2 -->
        		<div class="tab-pane fade" id="nav-wijzigen" role="tabpanel" aria-labelledby="nav-wijzigen">
				<div class="row">					
					<div class="col-md-12">
						<table class="table">
							<thead>
								<tr>								
									<th>Locatie ID</th>
									<th>Plaats</th>
									<th>Adres</th>
                                                                        <th>Postcode</th>
                                                                        <th>Hoofdnummer</th>
                                                                        <th>Intern nummer</th>
                                                                        <th>Layout ID</th>
                                                                        <th>Thema ID</th>
                                                                        <th>Update</th>
                                                                        <th>Verwijderen</th>
								</tr>
                                                                <tr>
                                                                    	<?php
                                                                            $stringBuilder = "SELECT * FROM location";
                                                                            $query = GetDatabaseConnection()->prepare($stringBuilder);
                                                                            $query->execute();
	
                                                                            while($location = $query->fetch())
                                                                                    {
                                                                                    echo("<tr>");
                                                                                    echo("
                                                                                        <td>".$location['location_id'] ."</td>
                                                                                        <td>".$location['name'] ."</td>
                                                                                        <td>".$location['address'] ."</td>
                                                                                        <td>".$location['postal_code'] ."</td>
                                                                                        <td>".$location['main_number'] ."</td>
                                                                                        <td>".$location['intern_number'] ."</td>
                                                                                        <td>".$location['layout_id'] ."</td>
                                                                                        <td>".$location['theme_id'] ."</td>
                                                                                        <td><a href='../location/location_add.php?user_id=". $location["location_id"]."' class='btn btn-info btn-md'>Update</a></td>
                                                                                        <td><a href='../location/location_add.php?user_id1=". $location["location_id"]."' class='btn btn-info btn-md' name='delete'>Verwijderen</a></td>
                                                                                    ");
                                                                                    echo("</tr>");
                                                                                    }
                                                                            echo"</table>";
                                                                        ?>
                                                                </tr>
							</thead>
							<tbody id="location-list">
							</tbody>
						</table>
					</div>					
				</div>
			</div>
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
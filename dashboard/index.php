<?php
include 'include/framework.php';
include 'include/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<?php include 'include/css.php'; ?>
</head>
<body>
	<?php include 'include/navbar.php'; ?>
	<section id="dashboard-content" class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<!-- Locatie select -->
				<div class="row justify-content-end">
					<div class="form-group col-md-6">
						<select class="form-control" id="locations">
							<option value="">Kies een locatie</option>
							<?php
								foreach (GetLocations() as $row) {
									$location_id = $row["location_id"];
									$name = $row["name"];
									echo "<option value=\"$location_id\">$name</option>";
								}
								
							?>
						</select>
					</div>
				</div>
				<!-- Berichten -->
				<div id="news-articles"></div>
			</div>
			<div class="col-md-6">
				<div id="weather"></div>
				<div id="birthdays"></div>
			</div>
		</div>		

	</section>

	<?php include 'include/footer.php'; ?>

</body>
</html>
<?php
include '../include/framework.php';
include '../include/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard | Opmaak</title>
	<?php include '../include/css.php'; ?>
</head>
<body>
	<?php include '../include/navbar.php'; ?>
	<!-- Navigational tabs -->
	<section id="dashboard-content" class="container-fluid">
		<h1>Opmaak</h1>
			<?php

				if (isset($_POST["remove_layout"])) {
					$layout_id = $_POST["layout_id"];
					
					RemoveLayout($layout_id);
				}

				if (isset($_POST["add_layout"])) {					
					$font = $_POST["layout_font"];
					$font_color = $_POST["layout_font_color"];
					$background_color = $_POST["layout_background_color"];
					$default_background = uploadSingleFile($_FILES["layout_default_background"]);
					$logo = uploadSingleFile($_FILES["layout_logo"]);

					AddLayout($font, $font_color, $background_color, $default_background, $logo);
				}

			?>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table layout-section">
							<thead>
								<tr>
									<th>Lettertype</th>
									<th>Tekstkleur</th>
									<th>Achtergrondkleur</th>
									<th>Standaard achtergrond</th>
									<th>Logo</th>
									<th>Verwijderen</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php
										foreach (GetLayout() as $row) {
											$layout_id = $row["layout_id"];
											$font = $row["font"];
											$font_color = $row["font_color"];
											$background_color = $row["background_color"];
											$background_location = $row["backgroundLocation"];
											$logo_location = $row["logoLocation"];

											echo "<td>$font</td>";
											echo "<td>$font_color</td>";
											echo "<td>$background_color</td>";
											echo "<td><img src=\"$background_location\" class=\"img-thumbnail layout-img\"></td>";
											echo "<td><img src=\"$logo_location\" class=\"img-thumbnail layout-img\"></td>";
											echo "<td><button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#modal-remove-layout\" data-id=\"$layout_id\">Verwijderen</td>";
										}
									?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<button type="button" class="btn btn-primary btn-right-add" data-toggle="modal" data-target="#addLayout">Opmaak toevoegen</button>    
				</div>
			</div>
	</section>

	<!-- Modal for editing layout -->
	<div class="modal fade" id="editLayout" tabindex="-1" role="dialog" aria-labelledby="editLayoutLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editRightLabel">Bewerken recht</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>              
				<div class="modal-body">                    
					<div class="form-group">
						<label for="right-name" class="form-control-label">Naam:</label>
						<input type="text" class="form-control" id="right-name">
					</div>
					<div class="form-group">
						<label for="right-description" class="form-control-label">Beschrijving:</label>
						<textarea class="form-control" id="right-description"></textarea>
					</div>                  
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
					<input type="hidden" id="right-id">
					<button type="button" class="btn btn-success" id="save-right-edit">Opslaan</button>
				</div>              
			</div>
		</div>
	</div>

	<!-- Modal for adding layout -->
	<div class="modal fade" id="addLayout" tabindex="-1" role="dialog" aria-labelledby="addLayoutLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addRightLabel">Toevoegen opmaak</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="POST" enctype="multipart/form-data">
					<div class="modal-body">            
						<div class="form-group">
							<label for="right-name" class="form-control-label">Lettertype:</label>
							<input type="text" class="form-control" name="layout_font">
						</div>
						<div class="form-group">
							<label for="right-name" class="form-control-label">Tekstkleur:</label>
							<input type="text" class="form-control" name="layout_font_color">
						</div>
						<div class="form-group">
							<label for="right-name" class="form-control-label">Achtergrondkleur:</label>
							<input type="text" class="form-control" name="layout_background_color">
						</div>

						<div class="form-group">
							<label for="right-name" class="form-control-label">Standaard achtergrond:</label>
							<input class="btn btn-default" type="file" name="layout_default_background">
						</div>
						<div class="form-group">
							<label for="right-name" class="form-control-label">Logo:</label>
							<input class="btn btn-default" type="file" name="layout_logo">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
						<input type="submit" class="btn btn-success" name="add_layout" value="Opslaan">
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal for removing layout -->
	<div class="modal fade" id="modal-remove-layout" tabindex="-1" role="dialog" aria-labelledby="removeLayoutLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Verwijderen opmaak</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Weet jij zeker dat je de layout wilt verwijderen?</p>					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>    
					<form method="POST">
						<input type="hidden" name="layout_id" id="layout_id">						
						<input type="submit" class="btn btn-warning" name="remove_layout" value="Ja">
					</form>					
				</div>
			</div>
		</div>
	</div>

	<?php include '../include/footer.php'; ?>
</body>
</html>
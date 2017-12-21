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

				//Removing the layout
				if (isset($_POST["remove_layout"])) {
					$layout_id = $_POST["layout_id"];
					
					RemoveLayout($layout_id);
				}

				//Adding a layout
				if (isset($_POST["add_layout"])) {
					//A check to see if theres already a layout
					if(LayoutAlreadyExists()){
						$font = $_POST["layout_font"];
						$font_color = $_POST["layout_font_color"];
						$background_color = $_POST["layout_background_color"];
						$default_background = UploadSingleFile($_FILES["layout_default_background"]);
						$logo = UploadSingleFile($_FILES["layout_logo"]);

						if ($font != "" && $font_color != "" && $background_color != "" && $default_background != "" && $logo != ""){
							AddLayout($font, $font_color, $background_color, $default_background, $logo);	
						} else {
							echo "<div class=\"alert alert-warning\" role=\"alert\">Alle velden zijn verplicht</div>";
						}	
					} else {
						echo "<div class=\"alert alert-warning\" role=\"alert\">Er kan maar een layout worden toegevoegd</div>";
					}
				}

				//Editing a layout
				if (isset($_POST["edit_layout"])){
					$layout_id = $_POST["edit_layout_id"];
					$default_background_id = $_POST["edit_default_background"];
					$logo_id = $_POST["edit_logo"];
					$font = $_POST["edit_layout_font"];
					$font_color = $_POST["edit_layout_font_color"];
					$background_color = $_POST["edit_layout_background_color"];					

					//Uploading the new file if theres a new one selected
					if($_FILES["edit_layout_default_background"]["size"] != 0 && $_FILES["edit_layout_default_background"]["error"] == 0){
						//Saving the file id
						$default_background = UploadSingleFile($_FILES["edit_layout_default_background"]);
					} else {
						$default_background = "";
					}

					//Same goes for this
					if ($_FILES["edit_layout_logo"]["size"] != 0 && $_FILES["edit_layout_logo"]["error"] == 0) {
						$logo = UploadSingleFile($_FILES["edit_layout_logo"]);
					} else {
						$logo = "";
					}
					
					EditLayout($layout_id, $font, $font_color, $background_color, $default_background, $logo);
					//Removing the old file(s)
					if($default_background != ""){						
						RemoveSingleFile($default_background_id, $_POST["edit_background_location"]);
					}
					if($logo != ""){
						RemoveSingleFile($logo_id, $_POST["edit_logo_location"]);
					}
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
									<th></th>
									<th></th>
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
											$default_background = $row["default_background"];
											$logo = $row["logo"];
											$background_location = $row["backgroundLocation"];
											$logo_location = $row["logoLocation"];

											echo "<td>$font</td>";
											echo "<td>$font_color</td>";
											echo "<td>$background_color</td>";
											echo "<td><img src=\"$background_location\" class=\"img-thumbnail layout-img\"></td>";
											echo "<td><img src=\"$logo_location\" class=\"img-thumbnail layout-img\"></td>";
											echo "<td><button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#modal-edit-layout\" data-id=\"$layout_id\" data-font=\"$font\" data-fontcolor=\"$font_color\" data-backgroundcolor=\"$background_color\" data-defaultbackground=\"$default_background\" data-logo=\"$logo\" data-backgroundlocation=\"$background_location\" data-logolocation=\"$logo_location\">Bewerken</td>";
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
	<div class="modal fade" id="modal-edit-layout" tabindex="-1" role="dialog" aria-labelledby="editLayoutLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editRightLabel">Bewerken opmaak</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>              
				<form method="POST" enctype="multipart/form-data">
					<div class="modal-body">            
						<div class="form-group">
							<label for="right-name" class="form-control-label">Lettertype:</label>
							<input type="text" class="form-control" name="edit_layout_font" id="edit_layout_font">
						</div>
						<div class="form-group">
							<label for="right-name" class="form-control-label">Tekstkleur:</label>
							<input type="text" class="form-control" name="edit_layout_font_color" id="edit_layout_font_color">
						</div>
						<div class="form-group">
							<label for="right-name" class="form-control-label">Achtergrondkleur:</label>
							<input type="text" class="form-control" name="edit_layout_background_color" id="edit_layout_background_color">
						</div>
						<label for="right-name" class="form-control-label">Standaard achtergrond:</label>
						<div class="row">							
							<div class="col-md-6">
								<img class="img-fluid img-thumbnail" id="edit_layout_default_background">
							</div>
							<div class="col-md-6">
								<input class="btn btn-default" type="file" name="edit_layout_default_background">
							</div>
						</div>
						<label for="right-name" class="form-control-label">Logo:</label>
						<div class="row">
							<div class="col-md-6">
								<img class="img-fluid img-thumbnail" id="edit_layout_logo">
							</div>
							<div class="col-md-6">
								<input class="btn btn-default" type="file" name="edit_layout_logo">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
						<input type="hidden" name="edit_layout_id" id="edit_layout_id">
						<input type="hidden" name="edit_default_background" id="edit_default_background">
						<input type="hidden" name="edit_logo" id="edit_logo">
						<input type="hidden" name="edit_logo_location" id="edit_logo_location">
						<input type="hidden" name="edit_background_location" id="edit_background_location">
						<input type="submit" class="btn btn-success" name="edit_layout" value="Opslaan">
					</div>
				</form>
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
							<div class="row">
								<div class="col-md-5">
									<label for="right-name" class="form-control-label">Standaard achtergrond:</label>
								</div>
								<div class="col-md-7">
									<input class="btn btn-default" type="file" name="layout_default_background">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-5">
									<label for="right-name" class="form-control-label">Logo:</label>
								</div>
								<div class="col-md-7">
									<input class="btn btn-default" type="file" name="layout_logo">
								</div>
							</div>
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
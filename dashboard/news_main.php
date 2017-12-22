<?php
include 'include/framework.php';
include 'include/header.php';
include '../database.php';
include 'upload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Beheer | Nieuwsberichten</title>
	<?php include 'include/css.php'; ?>
</head>
<body>
	<?php include 'include/navbar.php'; 
	include 'news/news_send.php';?>
	
	<?php if (isset($_FILES["medium"]["name"])){
		print_r( $_FILES["medium"]);
	}
		
	
	?>
	
	<!-- Navigational tabs -->
	<section id="dashboard-content" class="container-fluid">
		<h1>Nieuwsberichten</h1>
		<nav class="nav nav-tabs" id="myTab" role="tablist">
			<?php if(CheckIfUserHasRight($_SESSION["admin"], "Aanmaken nieuwsbericht", $_SESSION["user_id"])){ ?>
				<a class="nav-item nav-link active" id="nav-toevoegen-tab" data-toggle="tab" href="#nav-toevoegen" role="tab" aria-controls="nav-toevoegen" aria-selected="true">Toevoegen</a>
			<?php } ?>
			<?php if(CheckIfUserHasRight($_SESSION["admin"], "Bewerken nieuwsbericht", $_SESSION["user_id"])){ ?>
				<a class="nav-item nav-link" id="nav-wijzigen-tab" data-toggle="tab" href="#nav-wijzigen" role="tab" aria-controls="nav-wijzigen" aria-selected="false">Wijzigen</a>
			<?php } ?>
		</nav>
		
		<!-- content of the tabs -->
		<div class="tab-content" id="nav-tabContent">
			
			<div id="message"></div>
			
			<?php if(CheckIfUserHasRight($_SESSION["admin"], "Aanmaken nieuwsbericht", $_SESSION["user_id"])){ ?>
			<!-- content of "toevoegen" -->
			<div class="tab-pane fade show active" id="nav-toevoegen" role="tabpanel" aria-labelledby="nav-toevoegen-tab">
				<h3 class="navtabs">Nieuw bericht</h3>
				<form action="news_main.php" method="POST" id="newsAddForm" enctype="multipart/form-data">
					<div class="form-group row">
						<label class="control-label col-2 col-form-label" for="title">Titel:</label>
						<div class="col-10">
							<input type="text" class="form-control" id="title" placeholder="Voer een titel in" name="title" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-2 col-form-label" for="file">Bestand(en):</label>
						<div class="col-10">
							<input class="btn btn-default" id="file" type="file" name="medium[]">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-2" for="priority">Prioriteit:</label>
						<div class="col-10">
							<input class="mr-1" type="checkbox" id="priority" name="priority">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-2" for="date-from">Datum van:</label>
						<div class="col-10">
							<input type="date" id="date-from" name="date-from" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-2" for="date-till">Datum tot:</label>
						<div class="col-10">
							<input type="date" id="date-till" name="date-till" required="required">
						</div>
					</div>
					
					<?php include 'news/news_add.php' ?>
					
					<div class="form-group row">
						<label class="control-label col-2 col-form-label" for="description">Beschrijving:</label>
						<div class="col-10">
							<textarea name="description" class="form-control" form="newsAddForm" placeholder="Voer een beschrijving in"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="mr-auto col-10">
							<button type="submit" class="btn btn-default" name="submit" >Submit</button>
						</div>
					</div>
				</form>
			</div>
			<?php } ?>
			
			<!-- content of "wijzigen" -->
			<div class="tab-pane fade" id="nav-wijzigen" role="tabpanel" aria-labelledby="nav-wijzigen-tab">
				<div class="row">					
					<div class="col-md-12">
						<table class="table">
							<thead>
								<tr>								
									<th>Titel</th>
									<th>Beschrijving</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="newsArticles-tbody">
							</tbody>
						</table>	
					</div>					
				</div>
			</div>
		</div>
	</section>

	<!-- Modal for editing the newsarticle -->
	<div class="modal fade editNews" id="editNews" tabindex="-1" role="dialog" aria-labelledby="editNewsLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content">
	    		<div class="modal-header">
	        		<h5 class="modal-title" id="editNewsLabel">Bewerken nieuwsbericht</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>	      		
	      		<div class="modal-body">
					<div class="col-9">
						<form id="form-edit-modal" action="/get/news_article.php" enctype="multipart/form-data" method="post">
						<div class="form-group row">
							<label class="control-label col-2 col-form-label" for="news-title">Titel:</label>
							<div class="col-10">
								<input type="text" class="form-control" id="news-title" placeholder="Voer een titel in" name="news-title" required="required">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-2 col-form-label" for="news-file">Bestand(en):</label>
							<div class="col-10">
								<input class="btn btn-default" id="news-file" type="file" name="file">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-2" for="news-priority">Prioriteit:</label>
							<div class="col-10">
								<input class="mr-1" type="checkbox" id="news-priority" name="news-priority">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-2" for="news-date-from">Datum van:</label>
							<div class="col-10">
								<input type="date" id="news-date-from" name="news-date-from">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-2" for="news-date-till">Datum tot:</label>
							<div class="col-10">
								<input type="date" id="news-date-till" name="news-date-till">
							</div>
						</div>
					
						<?php include 'news/news_add.php' ?>
					
						<div class="form-group row">
							<label class="control-label col-2 col-form-label" for="news-description">Beschrijving:</label>
							<div class="col-10">
								<textarea name="news-description" class="form-control" id="news-description" form="newsAddForm" placeholder="Voer een beschrijving in" rows="6"></textarea>
							</div>
						</div>
						</form>
					</div>
					<div class="oldimg col-3">
						<img id="news-file-old" src="" alt="Het huidige bestand">
					</div>
				</div>
	      		<div class="modal-footer">
	      			<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
	      			<input type="hidden" id="newsarticle-id">
	        		<button type="button" class="btn btn-success" id="save-news-edit">Opslaan</button>
	      		</div>	      		
	    	</div>
	  	</div>
	</div>
	
	<!-- Modal for removing the newsarticle -->
	<div class="modal fade" id="modal-remove-news" tabindex="-1" role="dialog" aria-labelledby="removeNewsLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Verwijderen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Weet jij zeker dat je het nieuwsbericht "<span id="news-title"></span>" wilt verwijderen?</p>
					<input type="hidden" id="news-id">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>	 
					<button type="button" class="btn btn-warning" id="btn-remove-news">Ja</button>
				</div>
			</div>
		</div>
	</div>
	
	<?php include 'include/footer.php'; ?>
</body>
</html>
<?php
	/*
	foreach (GetNewsArticles() as $row) {
		
		$news_article_id = $row["news_article_id"];
		$title = $row["title"];
		$category_id = $row["category_id"];
		$file_id = $row["file_id"];
		$date = $row["date"];
		$display_from = $row["display_from"];
		$display_till = $row["display_till"];
		$priority = $row["priority"];
		$description = $row["description"];
		//File
		$file_location = $row["location"];
		//Location
		$location = $row["location_id"];

		echo "<a href=\"#\" data-toggle=\"modal\" data-target=\"#editNews\">";
		echo "<div class=\"row\">";
		echo "	<div class=\"col-md-12 news-section\">";
		echo "		<p class=\"title\">$title</p>";
		echo "		<div class=\"row\">";
		echo "			<div class=\"col-md-12 text-right\">";
		echo "				<img src=\"../img/icons/dots.png\">";
		echo "			</div>";
		echo "			<div class=\"col-md-6\">";
		echo "				<p>$description</p>";
		echo "			</div>";
		echo "			<div class=\"col-md-6 text-right\">";
		echo "				<img src=\"..$file_location\" class=\"img-thumbnail news-image\" alt=\"$title\">";
		echo "			</div>";
		echo "		</div>";
		echo "	</div>";
		echo "</div>";
		echo "</a>";
	}
	*/
	
?>
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


	<!-- Modal for editing the newsarticle -->
	<div class="modal fade" id="editNews" tabindex="-1" role="dialog" aria-labelledby="editNewsLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	    		<div class="modal-header">
	        		<h5 class="modal-title" id="editNewsLabel">Bewerken nieuwsbericht</h5>
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
<?php
	
	$stmt = $conn->prepare("SELECT * FROM (news_article na JOIN news_article_has_location nahl ON na.news_article_id = nahl.news_article_id) JOIN file f ON na.file_id = f.file_id");
	$stmt->execute();
	$articles = $stmt->fetchAll();
	
	var_dump($articles[0]);
	
	foreach ($articles as $article)
	
	
	/*
	$articleArrays = array();
	foreach ($articles as $k => $article) {
		if (isset
		
		
	}

*/
?>


	<!-- Modal for editing the newsarticle -->
	<div class="modal fade" id="modal-edit-article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Bewerk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Weet jij zeker dat je wilt uitloggen?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	 
					<form method="POST">
						<input type="submit" name="logout" class="btn btn-success" value="Uitloggen">
					</form>
				</div>
			</div>
		</div>
	</div>
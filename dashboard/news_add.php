<?php echo '
<h3 class="navtabs">Nieuw bericht</h3>
	<form action="news_manage.php" method="POST" id="newsAddForm" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Titel:</td>
				<td><input type="text" name="title"></td>
			</tr>
			<tr>
				<td>Bestand:</td>
				<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
				<td><input type="submit" value="Upload Image" name="upload"></td>
			</tr>
			<tr>
				<td>Bestandstype:</td>
				<td><select name="filetype">
					<option value="image" selected>Afbeelding</option>
					<option value="PDF">PDF</option>
					<option value="video">Video</option>
				</select></td> 
			</tr>
			<tr>
				<td>Prioriteit</td>
				<td><input type="checkbox" value="priority" name="priority"></td>
			</tr>
		</table>
		<input type="radio" value="none" name="category" selected>Geen categorie</br>
		<input type="radio" value="administration" name="category">Administratie</br>
		<input type="radio" value="event" name="category">Evenement</br>
		<input type="radio" value="worldnews" name="category">Wereldnieuws</br>
		<input type="radio" value="financial" name="category">Financieel</br>
		<img src="<?= $target_file; ?>" alt="no uploaded file"></br>
		Weergeven op locatie (één of meer):</br>
		<select name="location" multiple>
			<option value="nieuwleusen" selected>Nieuwleusen</option>
			<option value="dalen">Dalen</option>
			<option value="hoogeveen">Hoogeveen</option>
			<option value="nunspeet">Nunspeet</option>
			<option value="zwolle">Zwolle</option>
			<option value="amsterdam">Amsterdam</option>
			<option value="denhaag">Den Haag</option>
		</select></br>
					
					
		<input type="checkbox" value="priority" name="priority"></br>
		<input type="checkbox" value="priority" name="priority"></br>
		<input type="checkbox" value="priority" name="priority"></br>
		<input type="checkbox" value="priority" name="priority"></br>
		<input type="checkbox" value="priority" name="priority"></br>
		<input type="checkbox" value="priority" name="priority"></br>
		<input type="checkbox" value="priority" name="priority"></br>
		Beschrijving:</br>
		<textarea name="description" rows="5" cols="100" form="newsAddForm">ggwpman</textarea>
		<input type="submit" value="Klaar" name="submit"></br>
		<?= $_POST["description"]; ?>
		<?= $_POST["location"]; ?>
	</form>
'; ?>
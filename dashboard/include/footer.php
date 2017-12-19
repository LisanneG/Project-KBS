<img src="/KBS/Project-KBS/img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid dotsolutions_logo">

<!-- Modal for logging out -->
<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Uitloggen</h5>
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

<!-- Modal for user edit -->
<div class="modal fade" id="modal-user-edit" tabindex="-1" role="dialog" aria-labelledby="userEditLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="userEditLabel">Gebruikers informatie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST">
				<div class="modal-body">
					<div class="form-group">
	        			<label for="right-name" class="form-control-label">Naam</label>
	            		<input type="text" class="form-control" disabled name="user_name">
	          		</div>
	          		<div class="form-group">
	            		<label for="right-description" class="form-control-label">Geboortedatum:</label>	            		
	            		<input type="text" class="form-control" disabled name="user_birthday">
	          		</div>
	          		<div class="form-group">
	            		<label for="right-description" class="form-control-label">E-mail:</label>	            		
	            		<input type="text" class="form-control" disabled name="user_email">
	          		</div>
	          		<div class="form-group">
	            		<label for="right-description" class="form-control-label">Locatie:</label>	            		
	            		<input type="text" class="form-control" disabled name="user_email">
	          		</div>
	          		<div class="form-group">
	            		<label for="right-description" class="form-control-label">Wachtwoord:</label>
	            		<input type="text" class="form-control" name="user_password">
	            		<input type="submit" class="form-control" name="change_pass">
	          		</div>
	          		<!-- TODO: profile pic -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	 					
					<input type="submit" name="user_change" class="btn btn-success" value="Veranderen">					
				</div>
			</form>
		</div>
	</div>
</div>

<script src="/KBS/Project-KBS/js/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script type="text/javascript" src="/KBS/Project-KBS/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/KBS/Project-KBS/js/script.js"></script>
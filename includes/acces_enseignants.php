<div class="container-fluid">
	<div id="pad-wrapper" class="form-page">
		<div class="row-fluid form-wrapper">
			<!-- left column -->
			<div class="span8 column">
				
	<?php
	if(!isset($_SESSION['id']))
	{
	?>
	<h5>Authentification des enseignants</h6>
	<form action="?page=heures_prof" method="post">
	<input class="span6" type="text" name="cin_login" placeholder="Votre CIN"/>
		<div class="action">
		<input class="btn-flat success" type="submit" value="Valider"/>
		</div>
	</form>
	<?php
	}
	else
	{
	?>
	<div class="alert alert-error">
        <i class="icon-remove-sign"></i>
        Vous etes déjà connecté, veuillez vous déconnecter si vous souhaitez changer de compte
    </div>
	<?php
	}
	?>
			</div>                
		</div>
	</div>
</div>
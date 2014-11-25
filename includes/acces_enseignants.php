
<div class="row-fluid login-wrapper">
	<div class="box">
		<div class="content-wrap">
			<h6>Authentification des enseignants</h6>
<?php
if(!isset($_SESSION['id']))
{
?>

<form action="?page=heures_prof" method="post">
<input class="span6" type="text" name="cin" placeholder="Votre CIN"/>
	<div class="action">
	<input class="btn-glow primary signup" type="submit" value="Valider"/>
	</div>
</form>
<?php
}
else
{
?>
<h4>Vous etes déjà connecté, veuillez vous déconnecter si vous souhaitez changer de compte</h4>
<?php
}
?>
		</div>                
    </div>
</div>
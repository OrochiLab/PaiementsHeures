
<?php
if(!isset($_SESSION['id']))
{
?>

<form action="?page=panel_admin" method="post">
<h4>Espace d'administration</h4>
<pre>
Login          : <input type="text" name="login"/>

Mot de passe   : <input type="password" name="password"/>

<input type="submit" value="Valider"/>
</pre>
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
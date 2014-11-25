<?php
if(!isset($_SESSION['id']))
{
?>

<form action="?page=heures_prof" method="post">

<pre>
CIN               : <input type="text" name="cin"/>

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
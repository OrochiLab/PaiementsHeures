<?php



if(isset($_SESSION['id']))
{
	
	$admin = Responsable::getResponsable($_POST['login'],$_POST['password']);
	if(isset($admin))
	{
	?>
	<form action="?page=details_prof" method="post">
	<pre>
Entrez le CIN de l'enseignant : <input type="text" name="cin" size="5"/>

<input type="submit" value="Valider" />
	</pre>
	
	</form>
	
	
	
	</table>
	<?php
	}
	else
	{
		echo 'Compte invalide';
	}	


}
else
{
	echo 'Veuillez vous connecter';

}


?>
<?php



if(isset($_POST['login']) and isset($_POST['password']))
{
	
$admin = Responsable::getResponsable($_POST['login'],$_POST['password']);
	if(isset($admin))
	{
	?>
	<h4><?php echo ($admin->getType()=='admin'?'Administrateur':'Secretaire').' : '.$admin->getNom().' '.$admin->getPrenom();?></h4>
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
	echo 'Access Denied';

}


?>
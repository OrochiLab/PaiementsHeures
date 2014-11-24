<?php

if(isset($_POST['cin']))
{

	$prof = Professeur::getProfesseur($_POST['cin']);
	if(isset($prof))
	{
?>

<h4>Liste des heures supplémentaires/de vacation du professeur <?php echo $prof->getNom().' '.$prof->getPrenom();?></h4>
	<table border="1">
		<tr>
			<th>Date du jour</th>
			<th>Nombre d'heures</th>
			<th>Type d'heures</th>
			<th>Tranches</th>
			<th>Etablissement</th>
		</tr>
	<?php
	$tab = Heures::getByProf($prof->getCin());
	for($i=0;$i<count($tab);$i++)
	{
	?>
		<tr>
			<td><?php echo explode('#',$tab[$i])[0]; ?></td>
			<td><?php echo explode('#',$tab[$i])[1]; ?></td>
			<td><?php echo ((explode('#',$tab[$i])[2]=='sup')?'Supplémentaires':'Vacation'); ?></td>
			<td><?php echo explode('#',$tab[$i])[3]; ?></td>
			<td><?php echo explode('#',$tab[$i])[4]; ?></td>

		</tr>
	<?php
	}
	?>
	
	</table>
	<form action="?page=details_heures" method="post">
	<pre>
Heures   : <input type="radio" name="htype" value="sup" checked="checked"/> Supplémentaires <input type="radio" name="htype" value="vac"/> Vacation

Semestre : <input type="radio" name="semestre" value="s1" checked="checked"/> 1 <input type="radio" name="semestre" value="s2" /> 2

Année    : <select name="annee">
<option value="2013/2014">2013/2014</option>
<option value="2014/2015">2014/2015</option>
</select>
<input type="hidden" name="cin" value="<?php echo $prof->getCin(); ?>" />
<input type="hidden" name="id_prof" value="<?php echo $prof->getId(); ?>" />
<input type="submit" value="Valider" />

	</pre>
	</form>
	
	
	
	<?php
	}
	else
		echo 'CIN incorrect';
	?>

<?php


}



?>
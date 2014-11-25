<?php



if(isset($_SESSION['cin']))
{
	
$prof = Professeur::getProfesseur($_SESSION['cin']);
	if(isset($prof))
	{
		echo '<br/><br/>';
		echo 'Vous etes <strong>'.$prof->getGrade()->getLibelle().'</strong> à <strong>'.$prof->getEtablissement()->getLibelle().' - '.$prof->getEtablissement()->getUniversite()->getLibelle().'</strong>';
	
	?>
	
	<form action="?page=enregistrer_heures" method="post">
	<pre>
	<?php
	if($prof instanceof ProfesseurActivite)
	{
	?>
<input type="radio" name="htype" value="sup"/>Enregistrer des heures supplémentaires<br/>
	<?php
	}
	?>
<input type="radio" name="htype" value="vac" />Enregistrer des heures de vacation
	<input type="hidden" name="cin_prof" value="<?php echo $prof->getCin(); ?>" />
	
	
	<input type="submit" value="Valider"/>
	
	</pre>
	</form>
	
	<h4>Liste de vos heures supplémentaires/de vacation</h4>
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
	<?php
	}
	else
	{
		echo 'CIN introuvable';
	}	


}
else
{
	echo 'Access Denied, compte invalide';

}


?>
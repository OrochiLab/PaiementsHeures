<?php



if(isset($_SESSION['id']))
{
	?>

	<table class="table table-hover" align="center">
		<thead>
			<tr>
				<th style="text-align:center">CIN</th>
				<th style="text-align:center">Nom & Prenom</th>
				<th style="text-align:center">Grade</th>
				<th style="text-align:center">N° SOM</th>
				<th style="text-align:center">Etablissement d'origine</th>
				<th style="text-align:center">Opérations</th>
				
			</tr>
		</thead>
		
		<tbody>
	<?php
	
	$tab = Professeur::getAllCins();
	for($i=0;$i<count($tab);$i++)
	{
		$prof = Professeur::getProfesseur($tab[$i]);
	?>
		<tr>
			<td style="text-align:center"><?php echo $prof->getCin(); ?></td>
			<td style="text-align:center"><?php echo $prof->getNom().' '.$prof->getPrenom(); ?></td>
			<td style="text-align:center"><?php echo $prof->getGrade()->getId(); ?></td>
			<td style="text-align:center"><?php echo (($prof instanceof ProfesseurActivite)?$prof->getSom():'-'); ?></td>
			<td style="text-align:center"><?php echo $prof->getEtablissement()->getLibelle(); ?></td>
			<td>
			<form action="?page=details_prof" method="post">
				<input type="hidden" name="cin" value="<?php echo $prof->getCin(); ?>"/>
				<div class="action"><input class="btn-flat success" type="submit" value="Détails" /></div>
			</form>
			</td>
		</tr>
	<?php
	}
	?>
	
		</tbody>
	</table>
	
	<?php
		


}
else
{
	echo 'Veuillez vous connecter';

}


?>
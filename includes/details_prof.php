<?php

if(isset($_POST['cin']))
{

	$prof = Professeur::getProfesseur($_POST['cin']);
	if(isset($prof))
	{
?>

<h4>Liste des heures supplémentaires/de vacation du professeur <strong><?php echo $prof->getNom().' '.$prof->getPrenom();?></strong></h4><br/>
	<table class="table table-hover" align="center">
		<thead>
			<tr>
				<th style="text-align:center">Date du jour</th>
				<th style="text-align:center">Nombre d'heures</th>
				<th style="text-align:center">Type d'heures</th>
				<th style="text-align:center">Tranches</th>
				<th style="text-align:center">Etablissement</th>
			</tr>
		</thead>
		
		<tbody>
	<?php
	
	$tab = Heures::getByProf($prof->getCin());
	for($i=0;$i<count($tab);$i++)
	{
	?>
		<tr>
			<td style="text-align:center"><?php echo explode('#',$tab[$i])[0]; ?></td>
			<td style="text-align:center"><span class="label label-success"><?php echo explode('#',$tab[$i])[1]; ?></span></td>
			<td style="text-align:center"><?php echo ((explode('#',$tab[$i])[2]=='sup')?'<span class="label label-info">Supplémentaires</span>':'<span class="label">Vacation</span>'); ?></td>
			<td style="text-align:center"><?php echo explode('#',$tab[$i])[3]; ?></td>
			<td style="text-align:center"><?php echo explode('#',$tab[$i])[4]; ?></td>

		</tr>
	<?php
	}
	?>
	
		</tbody>
	</table>
	
	
<div class="container-fluid">
	<div id="pad-wrapper" class="form-page">
		<div class="row-fluid form-wrapper">
			<!-- left column -->
			<div class="span8 column">
	<form action="?page=details_heures" method="post">
<label>Heures : </label><?php if($prof instanceof ProfesseurActivite){?><input type="radio" name="htype" value="sup" checked="checked"/> Supplémentaires <?php }?><input type="radio" name="htype" value="vac" checked="checked"/> Vacation

<label>Semestre : </label><input  type="radio" name="semestre" value="s1" checked="checked"/> 1 <input type="radio" name="semestre" value="s2" /> 2

<label>Année universitaire</label><select  class="span6" name="annee">
<option value="2013/2014">2013/2014</option>
<option value="2014/2015">2014/2015</option>
</select><br/>
<input type="hidden" name="cin" value="<?php echo $prof->getCin(); ?>" />
<input type="hidden" name="id_prof" value="<?php echo $prof->getId(); ?>" />
<input class="btn-flat success" type="submit" value="Valider" />
	</form>
			</div>                
		</div>
	</div>
</div>	
	
	
	<?php
	}
	else
		echo 'CIN incorrect';
	?>

<?php


}



?>
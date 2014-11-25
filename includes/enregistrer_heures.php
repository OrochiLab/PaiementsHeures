
<div class="container-fluid">
	<div id="pad-wrapper" class="form-page">
		<div class="row-fluid form-wrapper">
			<!-- left column -->
			<div class="span6 column">
<?php
if(isset($_POST['valider']))
{
	$tab = $_POST['tranches'];
	$chaine ='';
	for($i=0;$i<count($tab);$i++)
	{
		$chaine = $chaine.' '.$tab[$i].',';
	}
	
	$res = Heures::enregistrer($_POST['dateh'],$_POST['nbre'],$_POST['htype'],$chaine,$_POST['id_prof'],$_POST['etab']);
	if($res=='true')
		echo 'Votre demande a été ajoutée<br/>';
	else
		echo 'Votre demande a echouée<br/>';

}




if(isset($_POST['htype']) and isset($_POST['cin_prof']))
{
	$prof = Professeur::getProfesseur($_POST['cin_prof']);
	echo '<h3>Enregistrement d\'heures '.(($_POST['htype']=='sup')?'supplémentaires':' de vacation').'</h3><br/>';
	?>
	<form action="#" method="post">
	<input type="hidden" name="htype" value="<?php echo $_POST['htype'];?>" />
	<input type="hidden" name="id_prof" value="<?php echo $prof->getId();?>" />
	
	<label>Enseignant : </label><input class="span6" type="text" disabled="disabled" value="<?php echo $prof->getNom().' '.$prof->getPrenom() ?>" />
	
	<label>Etablissement d'origine : </label><input class="span6" type="text" disabled="disabled" value="<?php echo $prof->getEtablissement()->getLibelle() ?>" />
	
	<label>Date du jour : </label><input class="span6" type="date" name="dateh" />
	
	<label>Nombre d'heures : </label><input class="span6" type="text" name="nbre" size="2" />
	
	<label>Etablissement : </label><select class="span6" name="etab" >
	<?php 
	$tab = Etablissement::getAll();
	for($i=0;$i<count($tab);$i++)
	{
	
		echo '<option value="'.$tab[$i]->getId().'">'.$tab[$i]->getLibelle().'</option>';
	}
	?>
	</select>
	
	<label>Tranches : </label>
	<table>
	<tr>
	<td><input type="checkbox" name="tranches[]" value="8h - 9h"/> 8h - 9h</td>
	<td><input type="checkbox" name="tranches[]" value="14h - 15h"/> 14h - 15h</td>
	</tr>
	<tr>
	<td><input type="checkbox" name="tranches[]" value="9h - 10h"/> 9h - 10h</td>
	<td><input type="checkbox" name="tranches[]" value="15h - 16h"/> 15h - 16h</td>
	</tr>
	<tr>
	<td><input type="checkbox" name="tranches[]" value="10h - 11h"/> 10h - 11h</td>
	<td><input type="checkbox" name="tranches[]" value="16h - 17h"/> 16h - 17h</td>
	</tr>
	<tr>
	<td><input type="checkbox" name="tranches[]" value="11h - 12h"/> 11h - 12h</td>
	<td><input type="checkbox" name="tranches[]" value="17h - 18h"/> 17h - 18h</td>
	</tr>
	<tr>
	
	
	
	
	</tr>
	</table>
	<input type="submit" value="Valider" name="valider"/>
	</form>
	
	
	<?php

}
?>
			</div>                
		</div>
	</div>
</div>
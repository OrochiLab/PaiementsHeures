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
	echo '<h4>Enregistrement d\'heures '.(($_POST['htype']=='sup')?'supplémentaires':' de vacation');
	?>
	<form action="#" method="post">
	<input type="hidden" name="htype" value="<?php echo $_POST['htype'];?>" />
	<input type="hidden" name="id_prof" value="<?php echo $prof->getId();?>" />
	
	<pre>
	Enseignant              : <input type="text" disabled="disabled" value="<?php echo $prof->getNom().' '.$prof->getPrenom() ?>" />
	
	Etablissement d'origine : <input type="text" disabled="disabled" value="<?php echo $prof->getEtablissement()->getLibelle() ?>" />
	
	Date du jour            : <input type="date" name="dateh" />
	
	Nombre d'heures         : <input type="text" name="nbre" size="2" />
	
	Etablissement           : <select name="etab" >
	<?php 
	$tab = Etablissement::getAll();
	for($i=0;$i<count($tab);$i++)
	{
	
		echo '<option value="'.$tab[$i]->getId().'">'.$tab[$i]->getLibelle().'</option>';
	}
	?>
	</select>
	
	Tranches                : 
	
	<input type="checkbox" name="tranches[]" value="8h - 9h"/> 8h - 9h
	<input type="checkbox" name="tranches[]" value="9h - 10h"/> 9h - 10h
	<input type="checkbox" name="tranches[]" value="10h - 11h"/> 10h - 11h
	<input type="checkbox" name="tranches[]" value="11h - 12h"/> 11h - 12h
	<input type="checkbox" name="tranches[]" value="14h - 15h"/> 14h - 15h
	<input type="checkbox" name="tranches[]" value="15h - 16h"/> 15h - 16h
	<input type="checkbox" name="tranches[]" value="16h - 17h"/> 16h - 17h
	<input type="checkbox" name="tranches[]" value="17h - 18h"/> 17h - 18h

	<input type="submit" value="Valider" name="valider"/>
	</pre>
	</form>
	
	
	<?php

}






?>
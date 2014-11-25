
<div class="container-fluid">
	<div id="pad-wrapper" class="form-page">
		<div class="row-fluid form-wrapper">
			<!-- left column -->
			<div class="span9 column">
<?php
if(isset($_SESSION['cin']))
{
	
$prof = Professeur::getProfesseur($_SESSION['cin']);
	if(isset($prof))
	{
		echo '<br/><br/>';
		echo 'Vous etes <strong>'.$prof->getGrade()->getLibelle().'</strong> à <strong>'.$prof->getEtablissement()->getLibelle().' - '.$prof->getEtablissement()->getUniversite()->getLibelle().'</strong>';
	
	?>
	
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
	
	</div>  
			<!-- side right column -->
                    <div class="span3 form-sidebar pull-right">
                        <div class="alert alert-info hidden-tablet">
                            <i class="icon-lightbulb pull-left"></i>
                            Vous pouvez enregistrer vos heures supplémentaires ou de vacations a condition de ne pas dépasser 20 par mois !
                        </div>                        
                        <h4>Enregistrer des heures</h4>
						<br/>
                        <form action="?page=enregistrer_heures" method="post">
							<?php
							if($prof instanceof ProfesseurActivite)
							{
							?>
								<input type="radio" name="htype" value="sup"/> Enregistrer des heures supplémentaires<br/>
							<?php
							}
							?>
								<input type="radio" name="htype" value="vac" /> Enregistrer des heures de vacation<br/>
								<input type="hidden" name="cin_prof" value="<?php echo $prof->getCin(); ?>" /><br/>	
								<input class="btn-flat success" type="submit" value="Valider"/>
						</form>
                    </div>
	<?php
	}
	else
	{
		echo 'CIN introuvable';
	}	


}
else
{
	?>
	<div class="alert alert-error">
		<i class="icon-remove-sign"></i>
		Erreur, Access denied 
	</div>
	<?php

}


?>
			

			
		</div>
	</div>
</div>
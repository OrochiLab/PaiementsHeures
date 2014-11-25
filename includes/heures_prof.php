
<div class="container-fluid">
	<div id="pad-wrapper" class="form-page">
		<div class="row-fluid form-wrapper">
			<!-- left column -->
			<div class="span12 column">
<?php
if(isset($_SESSION['cin']))
{
	
$prof = Professeur::getProfesseur($_SESSION['cin']);
	if(isset($prof))
	{
	?>
	
	<!-- side right column -->
				<div class="span12">
                    <div style="margin:auto;" class="span6 form-sidebar form-page">
                        <div class="alert alert-info hidden-tablet">
                            <i class="icon-lightbulb pull-left"></i>
                            Vous pouvez enregistrer vos heures supplémentaires ou de vacations a condition de ne pas dépasser 20 par mois !
                        </div>                        
                        <h4>Enregistrer des heures</h4>
						<br/>
                        <form class="form-wrapper" action="?page=enregistrer_heures" method="post">
							<?php
							if($prof instanceof ProfesseurActivite)
							{
							?>
								<label class="radio">
									<input type="radio" name="htype" value="sup" checked="checked"/> Enregistrer des heures supplémentaires
								</label>
							<?php
							}
							?>
								<label class="radio">
									<input type="radio" name="htype" value="vac" /> Enregistrer des heures de vacation
								</label>
								<input type="hidden" name="cin_prof" value="<?php echo $prof->getCin(); ?>" /><br/>	
								<input class="btn-flat success" type="submit" value="Valider"/>
						</form>
                    </div>
				</div>
	
	<h4>Liste de vos heures supplémentaires ou de vacations</h4>
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
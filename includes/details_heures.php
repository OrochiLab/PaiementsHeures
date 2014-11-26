<?php
if(isset($_POST['id_prof']) and ($_SESSION['type']=='admin' or $_SESSION['type']=='secretaire'))
{
$donnes = Heures::getBySem($_POST['id_prof'],$_POST['semestre'],$_POST['annee'],$_POST['htype']);
$prof = Professeur::getProfesseur($_POST['cin']);
$chemin = '_'.$_POST['htype'].'_'.explode('/',$_POST['annee'])[0].'_'.explode('/',$_POST['annee'])[1].'_'.$_POST['semestre'].'_'.$prof->getCin().'.pdf';
if(isset($prof))
{
	$pdf = new PdfGenerator($_POST['semestre'],$_POST['annee'],$_POST['htype'],$prof->getCin());
	
	if($_SESSION['type']=='admin')
		$pdf->generation();
	else
		$pdf->secretairePdf();
}
?>
<table border="1">
<tr>
	<th>Mois</th>
	<th>Année</th>
	<th>Total</th>
	<th>Lundi</th>
	<th>Mardi</th>
	<th>Mercredi</th>
	<th>Jeudi</th>
	<th>Vendredi</th>
	<th>Samedi</th>
	<th>Dimanche</th>
	<?php
	if($_SESSION['type']=='admin')
	{
	?>
	<th>Taux horaire</th>
	<th>Total</th>
	<?php
	}
	?>
</tr>
<?php
$total=0;
for($i=0;$i<count($donnes);$i++)
{
	$total+=$prof->getGrade()->getIndemnite()*($donnes[$i]['total']);
?>
<tr>
	<td><?php echo $donnes[$i]['mois']; ?></td>
	<td><?php echo $donnes[$i]['annee']; ?></td>
	<td><?php echo $donnes[$i]['total']; ?></td>
	<td><?php echo $donnes[$i]['lundi']; ?></td>
	<td><?php echo $donnes[$i]['mardi']; ?></td>
	<td><?php echo $donnes[$i]['mercredi']; ?></td>
	<td><?php echo $donnes[$i]['jeudi']; ?></td>
	<td><?php echo $donnes[$i]['vendredi']; ?></td>
	<td><?php echo $donnes[$i]['samedi']; ?></td>
	<td><?php echo $donnes[$i]['dimanche']; ?></td>
	<?php 
	if($_SESSION['type']=='admin')
	{
		if($i==0)
		{
		?>
		<td rowspan="<?php echo (($_POST['semestre']=='s1'?'6':'6'));?>"><?php echo $prof->getGrade()->getIndemnite(); ?></td>
		<?php 
		}
		?>
		<td><?php echo $prof->getGrade()->getIndemnite()*$donnes[$i]['total']; ?></td>
	<?php
	}
	?>
</tr>
<?php
}
?>
<?php 
	if($_SESSION['type']=='admin')
	{
?>
<tr>
<td colspan="12" align="right"><strong>Total : <?php echo $total; ?></strong></td>
</tr>
	<?php
	}
	?>
</table>

<br/><br/>
<?php 
if($_SESSION['type']=='admin')
{
?>
<table border="1">
	<tr>
		<th>Montant Brut</th>
		<?php 
		if($_POST['htype']=='sup')
		{
		?>
		<th>Frais professionnelle 20%</th>
		<th>Montant imposable</th>
		<th>Impôt à 40%</th>
		<th>Montant Net</th>
		<?php
		}
		else
		{
		?>
		<th>Impôt à 17%</th>
		<th>Montant Net</th>
		<?php
		}
		?>
		
	</tr>
	<tr>
		<td><?php echo $total; ?></td>
		<?php 
		if($_POST['htype']=='sup')
		{
		?>
		<td><?php echo $total*0.2; ?></td>
		<td><?php echo $total*0.8; ?></td>
		<td><?php echo $total*0.8*0.4; ?></td>
		<td><?php echo ($total*0.2)+($total*0.8*0.6);?></td>
		<?php
		}
		else
		{
		?>
		<td><?php echo $total*0.17; ?></td>
		<td><?php echo $total-($total*0.17); ?></td>
		<?php
		}
		?>
	</tr>

</table>
<br/>
<?php
if($_POST['htype']=='sup')
{
?>
<a class="btn-flat default" target="_blank" href="Pieces_Justificatifs/Etat_Recapitulatif_sup/Etat_Recapitulatif<?php echo $chemin; ?>">Etat récapitulatif</a>
<a class="btn-flat default"  target="_blank"  href="Pieces_Justificatifs/Etat_de_prelevement_heures_sup/Etat_de_prelevement_heures<?php echo $chemin; ?>">Etat de prélévement</a>
<a class="btn-flat default"  target="_blank"  href="Pieces_Justificatifs/Ordres_paiements/Ordres_paiements_Prof<?php echo $chemin; ?>">Ordre Paiement (Professeur)</a>
<a class="btn-flat default"  target="_blank"  href="Pieces_Justificatifs/Ordres_paiements/Ordres_paiements_Percepteur<?php echo $chemin; ?>">Ordre Paiement (Percepteur)</a>
<?php
}
else
{
?>
<a class="btn-flat default" target="_blank" href="Pieces_Justificatifs/Etat_Recapitulatif_vac/Etat_Recapitulatif<?php echo $chemin; ?>">Etat récapitulatif</a>
<a class="btn-flat default"  target="_blank"  href="Pieces_Justificatifs/Etat_de_prelevement_heures_vac/Etat_de_prelevement_heures<?php echo $chemin; ?>">Etat de prélévement</a>
<a class="btn-flat default"  target="_blank"  href="Pieces_Justificatifs/Ordres_paiements/Ordres_paiements_Prof<?php echo $chemin; ?>">Ordre Paiement (Professeur)</a>
<a class="btn-flat default"  target="_blank"  href="Pieces_Justificatifs/Ordres_paiements/Ordres_paiements_Percepteur<?php echo $chemin; ?>">Ordre Paiement (Percepteur)</a>
<?php
}

}
else
{
?>
<a class="btn-flat default"  target="_blank"  href="Pieces_Justificatifs/Etat_de_somme_heures_sup/Etat_de_somme_heures<?php echo substr($chemin,4); ?>">Etat de somme des heures</a>
<?php
}
}
?>

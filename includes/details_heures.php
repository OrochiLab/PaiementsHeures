<?php
if(isset($_POST['id_prof']))
{
$donnes = Heures::getBySem($_POST['id_prof'],$_POST['semestre'],$_POST['annee'],$_POST['htype']);
$prof = Professeur::getProfesseur($_POST['cin']);
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
	<th>Taux horaire</th>
	<th>Total</th>
</tr>
<?php
$total=0;
for($i=0;$i<count($donnes);$i++)
{
	$total+=300*($donnes[$i]['total']);
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
	if($i==0)
	{
	?>
	<td align="center" rowspan="<?php echo (($_POST['semestre']=='s1'?'6':'6'));?>"><?php echo $prof->getGrade()->getIndemnite(); ?></td>
	<?php 
	}
	?>
	<td><?php echo 300*$donnes[$i]['total']; ?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="12" align="right"><strong>Total : <?php echo $total; ?></strong></td>
</tr>
</table>
<br/><br/>
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
<?php
}


?>
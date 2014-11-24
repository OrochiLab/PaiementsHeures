
<?php
require_once('Metier/Professeur.class.php');
require_once('Metier/Etablissement.class.php');
require_once('Metier/Heures.class.php');
require_once('Metier/Responsable.class.php');



?>





<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php
		if(!isset($_GET['page']))
			$_GET['page']='accueil';
	
	
		switch($_GET['page'])
		{
		
			case 'accueil':
			include_once('includes/accueil.php');
			break;
			
			case 'prof':
			include_once('includes/acces_enseignants.php');
			break;
			
			case 'administration':
			include_once('includes/acces_administration.php');
			break;
			
			case 'heures_prof':
			include_once('includes/heures_prof.php');
			break;
			
			case 'enregistrer_heures':
			include_once('includes/enregistrer_heures.php');
			break;
			
			case 'panel_admin':
			include_once('includes/panel_administration.php');
			break;
			
			case 'details_prof':
			include_once('includes/details_prof.php');
			break;
			
			case 'details_heures':
			include_once('includes/details_heures.php');
			break;
			
			case 'details_heures':
			include_once('includes/details_heures.php');
			break;
			
			default:
			include_once('includes/accueil.php');
			break;
			
		}
	?>
</body>
</html>
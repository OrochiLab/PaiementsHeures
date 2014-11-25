
<?php
require_once('Metier/Professeur.class.php');
require_once('Metier/Etablissement.class.php');
require_once('Metier/Heures.class.php');
require_once('Metier/Responsable.class.php');
session_start();


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
			
		
		if($_GET['page']=='deconnexion')
		{
			$_SESSION = array();
			session_destroy();
		}
		
		
		if(isset($_POST['login']) and isset($_POST['password']))
		{
	
		$admin = Responsable::getResponsable($_POST['login'],$_POST['password']);
		if(isset($admin))
		{
			$_SESSION['type']=$admin->getType();
			$_SESSION['id']=$admin->getId();
			$_SESSION['nom']=$admin->getNom();
			$_SESSION['prenom']=$admin->getPrenom();
		}
		}
		
		if(isset($_POST['cin']))
		{
	
		$prof = Professeur::getProfesseur($_POST['cin']);
		if(isset($prof))
		{
			$_SESSION['type']='prof';
			$_SESSION['id']=$prof->getId();
			$_SESSION['nom']=$prof->getNom();
			$_SESSION['prenom']=$prof->getPrenom();
			$_SESSION['cin']=$prof->getCin();
		}
		}
	
	
		
		if(isset($_SESSION['id']))
		{
		echo 'Bonjour <strong>'.($_SESSION['type']=='admin'?'Administrateur':($_SESSION['type']=='secretaire'?'Secretaire':'Professeur')).' '.$_SESSION['nom'].' '.$_SESSION['prenom'].'</strong> ';
		echo '<a href="?page=deconnexion">Se Déconnecter</a>';
		}
		else
		{
			if($_GET['page']!='accueil' and $_GET['page']!='deconnexion')
				echo '<a href="?page=accueil">Retour a la page d\'accueil</a><br/><br/>';
		
		}
	?>


	<?php
		
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
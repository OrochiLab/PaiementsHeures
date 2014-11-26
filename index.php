<?php
require_once('Metier/Professeur.class.php');
require_once('Metier/Etablissement.class.php');
require_once('Metier/Heures.class.php');
require_once('Metier/Responsable.class.php');
require_once('pdf/fpdf.php');
require_once('Metier/Pdf_Generator.class.php');
require_once('Metier/Pdf_1_Vacation.class.php');
require_once('Metier/Pdf_2_Vacation.class.php');
require_once('Metier/Pdf_Etat_prelevement_sup.Class.php');
require_once('Metier/Pdf_Etat_prelevement_vacation.Class.php');
require_once('Metier/Pdf_Etat_somme_HSup.class.php');
require_once('Metier/Pdf_Recap.class.php');
require_once('Metier/Pdf_Recap_vacation.class.php');
require_once('Metier/Pdf_1_Sup.php');
require_once('Metier/Pdf_2_Sup.php');
require_once('Metier/NombreToHorof.class.php');

session_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />    

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
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
		
		if(isset($_POST['cin_login']))
		{
	
		$prof = Professeur::getProfesseur($_POST['cin_login']);
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
		?>
		
		<!-- navbar -->
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<a class="brand" href="?page=accueil"><img src="img/logo.png" /></a>

				<ul class="nav pull-right">                
					
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
							<?php echo ($_SESSION['type']=='admin'?'Administrateur':($_SESSION['type']=='secretaire'?'Secretaire':'Professeur')).' <strong>'.$_SESSION['nom'].' '.$_SESSION['prenom'].'</strong>';?>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="?page=deconnexion">Déconnexion</a></li>
						</ul>
					</li>
					<li class="settings hidden-phone">
						<a href="#" role="button">
							<i class="icon-cog"></i>
						</a>
					</li>
				</ul>            
			</div>
		</div>
    <!-- end navbar -->
		
		<?php
		
		}
		else
		{
		
		?>
	
	<div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a class="brand" href="?page=accueil"><img src="img/logo.png" /></a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="<?php echo (($_GET['page']=='prof')?'active':'');?>"><a href="?page=prof">Accès Enseignants</a></li>
                    <li class="<?php echo (($_GET['page']=='administration')?'active':'');?>"><a href="?page=administration">Accès Administration</a></li>
                </ul>
            </div>
            
        </div>
    </div>
	
		<?php
		}
		?>

	
	
	
	
	<!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li class="<?php echo (($_GET['page']=='accueil')?'active':'');?>">
                <?php
				if($_GET['page']=='accueil')
				{
				?>
				<div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
				<?php
				}
				?>
                <a href="?page=accueil">
                    <i class="icon-home"></i>
                    <span>Accueil</span>
                </a>
            </li>      
			<?php 
			if(isset($_SESSION['type']) and $_SESSION['type']=='prof')
			{
			?>
			<li class="<?php echo (($_GET['page']=='heures_prof')?'active':'');?>">
				<?php
				if($_GET['page']=='heures_prof')
				{
				?>
				<div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
				<?php
				}
				?>
                <a href="?page=heures_prof">
                    <i class="icon-calendar-empty"></i>
                    <span>Heures</span>
                </a>
            </li>	
			<?php
			}
			
			if(isset($_SESSION['type']) and $_SESSION['type']!='prof')
			{
			?>
			<li class="<?php echo (($_GET['page']=='panel_admin')?'active':'');?>">
				<?php
				if($_GET['page']=='panel_admin')
				{
				?>
				<div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
				<?php
				}
				?>
                <a href="?page=panel_admin">
                    <i class="icon-calendar-empty"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>
			
			<?php
			}
			?>
            <!--<li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-group"></i>
                    <span>Users</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="user-list.html">User list</a></li>
                    <li><a href="new-user.html">New user form</a></li>
                    <li><a href="user-profile.html">User profile</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-edit"></i>
                    <span>Forms</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="form-showcase.html">Form showcase</a></li>
                    <li><a href="form-wizard.html">Form wizard</a></li>
                </ul>
            </li>-->
            
        </ul>
    </div>
    <!-- end sidebar -->
	
	
	<div class="content">
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
	</div>
	
	
		<!-- scripts -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="js/jquery.flot.js"></script>
    <script src="js/jquery.flot.stack.js"></script>
    <script src="js/jquery.flot.resize.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>
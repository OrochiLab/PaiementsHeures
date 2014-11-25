<?php
		require_once('../pdf/fpdf.php');
		//require_once('../Metier/Etudiant.class.php');
		class PDF_5 extends FPDF
		{
		// En-tête
			function Header()
			{
			    // Logo
			    $this->Image('../img/logo_ensak.jpg',10,6,30);
			    // Police Arial gras 15
			    $this->SetFont('Arial','B',13);
			    // Décalage à droite
			    $this->Cell(100);
			    // Titre
			    $this->Cell(30,10,utf8_decode('Ecole Nationale des Sciences Appliquées Khouribga'),10,0,'C');
			    // Saut de ligne
			    $this->Ln(20);
			}

			// Pied de page
			function Footer()
			{
			    // Positionnement à 1,5 cm du bas
			    $this->SetY(-15);
			    // Police Arial italique 8
			    $this->SetFont('Arial','I',8);
			    // Numéro de page
			    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			}		

	// Colored table
	function FancyTable($chemin,$data,$cin,$nometprenom,$grade,$categorie,$ets,$som,$year,$som,$frais)
	{	
		$this->SetFont('Arial','',10);
		$this->AddPage();
		$this->Cell(0,0,"UNIVERSITE HASSAN 1ER SETTAT");
		$this->Ln(3);
		$this->SetXY($this->getX()+120,$this->getY()-3);
		$this->MultiCell(0,0,"EX. de l'annee universitaire ".$year);
		$this->SetXY($this->getX()+145,$this->getY()+5);
		$this->Cell(0,0,"ART.II P:85L.10");
		$this->SetXY($this->getX()-65,$this->getY()+5);
		$this->Cell(0,0,utf8_decode("APPLICATION DECRET N°2.08.11"));
		$this->SetXY($this->getX()-160,$this->getY()+5);
		$this->SetFont('Times','BU',14);
		$this->MultiCell(0,0,utf8_decode("Fiche secretaire"));
		$this->Ln(6);
		$this->SetFont('Arial','',10);
		$this->MultiCell(0,5,utf8_decode("S.O.M :  ".$som));
		$this->MultiCell(0,5,utf8_decode("NOM & PRENOM :  ".$nometprenom));
		$this->MultiCell(0,5,utf8_decode("GRADE :  ".$grade));
		$this->MultiCell(0,5,utf8_decode("CATEGORIE :  ".$categorie));
		//$this->MultiCell(0,5,utf8_decode("MATIERE :  --"));
		$this->MultiCell(0,5,utf8_decode("ETABLISSEMENT D'ORIGINE :  ".$ets));
		//$this->MultiCell(0,5,utf8_decode("REFERENCE :  --"));
		$this->MultiCell(0,5,utf8_decode("NOMBRES D'HEURES ASSUREES :  ".$frais['nbreHeures']));
		$this->Ln(3);

		$this->SetFont('Times','',8);
		$header = array('MOIS', 'ANNEE', "LUNDI","MARDI","MERCREDI","JEUDI","VENDREDI","SAMEDI","DIMANCHE",'TOTAL');
	    // Colors, line width and bold font
	    $this->SetFillColor(255,0,0);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(128,0,0);
	    $this->SetLineWidth(.3);
	    // Header
	    $w = array(27, 17, 17,17,17,17,17,17,17,20);
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    $this->Ln();
	    // Color and font restoration
	    $this->SetFillColor(220,235,255);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    // Data
	    $fill = false;
	    $aa  = array('2021','2020','2558' );
	    $prof = Professeur::getProfesseur($cin);
		$this->SetFont('Arial','',10);

	    for($i=0;$i<count($data);$i++)
	    {

	        $this->Cell($w[0],6,$data[$i]['mois'],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$data[$i]['annee'],'LR',0,'C',$fill);
			$this->Cell($w[2],6,$data[$i]['lundi'],'LR',0,'C',$fill);
			$this->Cell($w[3],6,$data[$i]['mardi'],'LR',0,'C',$fill);
			$this->Cell($w[4],6,$data[$i]['mercredi'],'LR',0,'C',$fill);
			$this->Cell($w[5],6,$data[$i]['jeudi'],'LR',0,'C',$fill);
			$this->Cell($w[6],6,$data[$i]['vendredi'],'LR',0,'C',$fill);
			$this->Cell($w[7],6,$data[$i]['samedi'],'LR',0,'C',$fill);
			$this->Cell($w[8],6,$data[$i]['dimanche'],'LR',0,'C',$fill);
			$this->Cell($w[9],6,$data[$i]['total'],'LR',0,'R',$fill);
	        $this->Ln();
	        $fill = !$fill;
	    }
	    
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	    $this->MultiCell(array_sum($w)-7,0,$this->Rect($this->getX()-20, $this->getY(), 20, 6));
	    $this->MultiCell(array_sum($w)-7,5,$this->Rect($this->getX()+146, $this->getY(), 17, 6));
	    $this->SetXY($this->getX()+147,$this->getY()-2);
	    $this->Cell(0,0,'TOTAL');   
	   	$this->SetXY($this->getX()-27,$this->getY());
	    $this->Cell(0,0,$frais['nbreHeures']);
		$this->SetXY(10,$this->getY()+5);
		$this->MultiCell(0,5,utf8_decode("Arrêté à la somme de : Huit milles siw quarante DHS"));
		$this->MultiCell(0,5,utf8_decode("L'ENSEIGNANT :  ".$nometprenom));
		$this->SetXY(75,$this->getY()+15);
		$this->SetFont("Times","BU",12);
		$this->MultiCell(0,5,utf8_decode(""));
		$this->Ln(5);
		$this->SetFont("Arial","",10);
		
	    $this->Ln();
	    // Color and font restoration
	    $this->SetXY(130,$this->getY()+10);
	    $this->Cell(0,0,"Khouribga Le : ".DATE('d/m/Y'));
	    $this->SetXY($this->getX()-188,$this->getY()+30);
	    $this->Cell(0,0,"LE PRESIDENT : ");
	    $this->SetXY(130,$this->getY());
	    $this->Cell(0,0,"LE DOYEN : ");
	    $this->Output($chemin,'F');
	}


}
?>
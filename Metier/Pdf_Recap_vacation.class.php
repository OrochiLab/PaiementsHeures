<?php
		require_once('../pdf/fpdf.php');
		require_once('../Metier/Heures.class.php');
		require_once('NombreToHorof.class.php');
		require_once ('../Metier/Professeur.class.php');
		class PDF_7 extends FPDF
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
		$this->MultiCell(0,0,"EX. du ".$year." ART.II");
		$this->SetXY($this->getX()+130,$this->getY()+5);
		$this->Cell(0,0,"P:85L.10");
		$this->SetXY($this->getX()-75,$this->getY()+5);
		$this->Cell(0,0,utf8_decode("APPLICATION DECRET N°2.08.11"));
		$this->SetXY($this->getX()-160,$this->getY()+5);
		$this->SetFont('Times','BU',14);
		$this->MultiCell(0,0,utf8_decode("Etat des sommes dues pour heures vacations"));
		$this->Ln(6);
		$this->SetFont('Arial','',10);
		$this->MultiCell(0,5,utf8_decode("S.O.M :  ".$som));
		$this->MultiCell(0,5,utf8_decode("NOM & PRENOM :  ".$nometprenom));
		$this->MultiCell(0,5,utf8_decode("GRADE :  ".$grade));
		$this->MultiCell(0,5,utf8_decode("CATEGORIE :  ".$categorie));
		$this->MultiCell(0,5,utf8_decode("ETABLISSEMENT D'ORIGINE :  ".$ets));
		$this->MultiCell(0,5,utf8_decode("NOMBRES D'HEURES ASSUREES :  ".utf8_decode(strtoupper(NombreToHorof($frais['nbreHeures'])))." HEURES"));
		$this->Ln(3);

		$this->SetFont('Arial','',10);
		$header = array('MOIS', 'ANNEE', "NOMBRE D'HEURE DE VACCATIONS", 'TAUX HORAIRE','TOTAL');
	    // Colors, line width and bold font
	    $this->SetFillColor(255,0,0);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(128,0,0);
	    $this->SetLineWidth(.3);
	    // Header
	    $w = array(27, 17, 70, 27, 27);
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

	    for($i=0;$i<count($data);$i++)
	    {

	        $this->Cell($w[0],6,$data[$i]['mois'],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$data[$i]['annee'],'LR',0,'L',$fill);
			$this->Cell($w[2],6,$data[$i]['total'],'LR',0,'C',$fill);
			$this->Cell($w[3],6,$prof->getGrade()->getIndemnite(),'LR',0,'C',$fill);
			$this->Cell($w[4],6,($prof->getGrade()->getIndemnite())*$data[$i]['total']	,'LR',0,'L',$fill);
	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	    $this->MultiCell(array_sum($w)-7,0,$this->Rect($this->getX()-54, $this->getY(), 54, 6));
	    $this->MultiCell(array_sum($w)-7,5,$this->Rect($this->getX()+114, $this->getY(), 27, 6));
	    $this->SetXY($this->getX()+113,$this->getY()-2);
	    $this->Cell(0,0,'TOTAL');
	   	$this->SetXY($this->getX()-45,$this->getY());
	    $this->Cell(0,0,$frais['brut']);
		$this->SetXY(10,$this->getY()+5);
		$this->MultiCell(0,5,utf8_decode("Arrêté à la somme de : ".utf8_decode(strtoupper(NombreToHorof($frais['brut'])))." DHS"));
		$this->MultiCell(0,5,utf8_decode("L'ENSEIGNANT :  ".$nometprenom));
		$this->SetXY(75,$this->getY()+15);
		$this->SetFont("Times","BU",12);
		$this->MultiCell(0,5,utf8_decode("Décompte des heures vacation"));
		$this->Ln(5);
		$this->SetFont("Arial","",10);
		$header_2 = array('Montant brut', 'Impôt à 17%','Montant Net');
	    $w = array(50, 50, 50);
	    for($i=0;$i<count($header_2);$i++)
	        $this->Cell($w[$i],7,utf8_decode($header_2[$i]),1,0,'C',true);
	    $this->Ln();
	    // Color and font restoration
	    $this->SetFillColor(220,235,255);
	    $this->SetTextColor(0);
	    $this->SetFont('');

	        $this->Cell($w[0],6,$frais['brut'],'LR',0,'C',$fill);
			$this->Cell($w[1],6,$frais['impot'],'C',0,'C',$fill);
			$this->Cell($w[2],6,$frais['net'],'LR',0,'C',$fill);
			$this->Ln();
	        $fill = !$fill;
	    $this->Cell(array_sum($w),0,'','T');
	    $this->Ln(4);
	    $this->Cell(0,0,utf8_decode('Arrêté à la somme de : '.utf8_decode(strtoupper(NombreToHorof($frais['net']))).' DHS'));
	    $this->SetXY(130,$this->getY()+10);
	    $this->Cell(0,0,"SETAT LE : ".DATE('d/m/Y'));
	    $this->SetXY($this->getX()-188,$this->getY()+30);
	    $this->Cell(0,0,"LE PRESIDENT : ");
	    $this->SetXY(130,$this->getY());
	    $this->Cell(0,0,"LE DOYEN : ");
	    $this->Output($chemin,'F');
	}


}
/*			$donnes = Heures::getBySem(1,"s1","2014/2015","sup");
			$pdf = new PDF();

			$pdf->FancyTable($donnes,"BK275058");
			$pdf->Output();*/
?>
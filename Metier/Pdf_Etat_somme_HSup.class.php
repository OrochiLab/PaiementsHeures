<?php
		require_once('../pdf/fpdf.php');
		//require_once('../Metier/Etudiant.class.php');
		class PDF extends FPDF
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
	// Load data
	function LoadData()
	{
	    $data = array("ouasmine"
	    				,"med"
	    				,"amine" ); ;
	    return $data;
	}

	// Colored table
	function FancyTable($data)
	{	
		$header = array('MOIS', 'ANNEE', "NOMBRE D'HEURE DE VACCATIONS", 'TAUX HORAIRE','TOTAL');
	    // Colors, line width and bold font
	    $this->SetFillColor(255,0,0);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(128,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
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
	    foreach($data as $row)
	    {
	        $this->Cell($w[0],6,$row,'LR',0,'L',$fill);
	        $this->Cell($w[1],6,$row,'LR',0,'L',$fill);
	        $this->Cell($w[2],6,$row,'LR',0,'L',$fill);
	        $this->Cell($w[3],6,$row,'LR',0,'L',$fill);
	        $this->Cell($w[4],6,$row,'LR',0,'L',$fill);

	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Closing line
	    $this->Cell(array_sum($w),0,'','T');
	}
}

$pdf = new PDF();
$data = $pdf->LoadData();
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->FancyTable($data);
$pdf->Output();
	
?>
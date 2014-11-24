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
		
			//print pdf demande

			function print_certificat()
			{	
				$this->SetFont('Arial','B',10);
				// Instanciation de la classe dérivée
				$this->AliasNbPages();
				$this->AddPage();
				$this->MultiCell(0,10,"EXCERCICE DU 01/01/2009 AU 31/12/2009");
				//$this->SetFont('Times','',12);
				$this->Ln(2);
				$this->Cell(10);
				$this->MultiCell(0,5,utf8_decode("Etat de"));
				$this->Cell(5);
				$this->MultiCell(0,5,utf8_decode("Prelevement"));
				$this->Cell(8);
				$this->MultiCell(0,5,utf8_decode("Heure de"));
				$this->Cell(8);
				$this->MultiCell(0,5,utf8_decode("vacation"));
				$this->Ln(3);
				$this->setFont('Arial','B',10);
				$this->Cell(5);
				$this->SetFont('Times','B',10);
				$this->Cell(5);
				
				$pas=7;
				for ($i=0; $i < 6; $i++) {
					$this->MultiCell(0,0,$this->Rect(10, 95, 20, 50));
					$this->Cell(110);
					$this->MultiCell(0,0,$this->Rect(30, 95, 30, 50));
					$this->Cell(110);
					$this->MultiCell(0,0,$this->Rect(60, 95, 30, 50));
					$this->Cell(110);
					$this->MultiCell(0,0,$this->Rect(90, 95, 30, 50));
					$this->Cell(110);
					$this->MultiCell(0,0,$this->Rect(120, 95, 30, 50));
					$this->Cell(110);
					$this->MultiCell(0,0,$this->Rect(150, 95, 30, 50));
					
					$this->MultiCell(0,0,$this->Line(10,95+$pas,180,95+$pas));
					$this->ln(3);
					$pas=$pas+7;
				}
				$this->Cell(110);
				$this->MultiCell(0,0,$this->Rect(10, 95, 170, 50));
				//$this->MultiCell(0,)
				$today = date('d/m/Y');
				$tab = explode("/",$today);
				
				//$this->Output('doc.pdf');
				$this->Output();
			}
		}

		
	$doc =  new PDF();
	$doc->print_certificat();		
?>
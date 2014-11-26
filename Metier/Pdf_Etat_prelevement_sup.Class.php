<?php

		class PDF_3 extends FPDF
		{
		// En-tête
			function Header()
			{
			    // Logo
			    $this->Image('img/logo_ensak.jpg',10,6,30);
			    // Police Arial gras 15
			    $this->SetFont('Arial','B',13);
			    // Décalage à droite
			    $this->Cell(100);
			    // Titre
			    $this->Cell(30,10,utf8_decode('Ecole Nationale des Sciences Appliquées Khouribga'),10,0,'C');
			    
			    // Saut de ligne
			    $this->Ln(25);
				


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

			function print_certificat($chemin,$frais,$year,$NomPrenom)
			{	
				$this->SetFont('Arial','B',10);
				// Instanciation de la classe dérivée
				$this->AliasNbPages();
				$this->AddPage();
				$this->MultiCell(0,10,"EXCERCICE DU ".$year);
				//$this->SetFont('Times','',12);
				$this->Ln(2);
				$this->Cell(10);
				$this->SetXY(75,80);
				$this->Cell(0,0,utf8_decode("ETAT DE PRELEVEMENT"));
				$this->Ln(3);
				$this->SetXY(85,85);
				$this->Cell(0,0,utf8_decode("HEURES SUP"));
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
				//header du tableau
				$this->SetXY(15,95);
				$this->Cell(10,6,"OP ");
				$this->SetXY(35,95);
				$this->Cell(10,6,utf8_decode("Bénéficiaire "));
				$this->SetXY(65,95);
				$this->Cell(10,6,"Taux IGR ");
				$this->SetXY(95,95);
				$this->Cell(10,6,"Montant Brut ");
				$this->SetXY(125,95);
				$this->Cell(10,6,utf8_decode("Impôt "));
				$this->SetXY(155,95);
				$this->Cell(10,6,"Montant NET ");

				//deuxieme ligne
				$this->setXY(65,102);
				$this->Cell(10,6,"35%");
				$this->setXY(95,102);
				$this->Cell(10,6,$frais['brut']);
				$this->setXY(125,102);
				$this->Cell(10,6,$frais['impot']);
				$this->setXY(155,102);
				$this->Cell(10,6,$frais['net']);

				//Footer du tableau
				$this->SetXY(40,137);
				$this->Cell(10,6,"Total ");
				$this->SetXY(100,137);
				$this->Cell(10,6,$frais['brut']);
				$this->SetXY(130,137);
				$this->Cell(10,6,$frais['impot']);
				$this->SetXY(160,137);
				$this->Cell(10,6,$frais['net']);



				$this->Cell(110);
				$this->MultiCell(0,0,$this->Rect(10, 95, 170, 50));
				$this->SetXY(10,210);
				$this->MultiCell(0,0,utf8_decode("Arrêté le présent état a la somme de : ".utf8_decode(strtoupper(NombreToHorof($frais['brut'])))." DHS"));
				$this->ln(5);
				$this->MultiCell(0,0,utf8_decode("Total à payer : ".utf8_decode(strtoupper(NombreToHorof($frais['net'])))." DHS"));
				//$this->MultiCell(0,)
				$today = date('d/m/Y');
				$tab = explode("/",$today);
				
				//$this->Output('doc.pdf');
				$this->Output($chemin,'F');
			}
		}

		
	
?>

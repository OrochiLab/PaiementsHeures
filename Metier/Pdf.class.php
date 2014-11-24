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
			    $this->Ln(20);
			    // Décalage à droite
			    //$this->Cell(100);
			    $this->SetFont('Arial','I',10);
			    $this->MultiCell(00,8,utf8_decode('Royaume du maroc'));
			    $this->MultiCell(00,8,utf8_decode('universite hassan 1er-settat-'));
			    $this->MultiCell(00,8,utf8_decode('ensa-khouribga'));
			    $this->Cell(130);
			    $this->MultiCell(00,8,utf8_decode('Ordre de paiment'));
			    $this->Ln(3);
			    $this->Cell(130);
			    $this->MultiCell(00,8,utf8_decode("Sur Ordre de l'imputation"));
			    $this->Cell(130);
			    $this->MultiCell(00,8,utf8_decode("De Monsieur le Directeur de"));
			    $this->Cell(130);
			
			    $this->MultiCell(00,8,utf8_decode("L'ENSA de Khouribga"));
			    $this->SetFont('Arial','B',13);
			    $this->Cell(30);
			    
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
				//$this->SetFont('Times','',12);
				$this->Ln(0);
				$this->Cell(5);
				$this->MultiCell(0,10,utf8_decode("Exercice		:		"));
				$this->Ln(3);
				$this->Cell(5);
				$this->MultiCell(0,10,utf8_decode("Article		:		"));
				$this->Ln(3);
				$this->Cell(5);
				$this->MultiCell(0,10,utf8_decode("Paragraphe	:		"));
				$this->Ln(3);
				$this->Cell(5);
				$this->MultiCell(0,10,utf8_decode("Ligne		:		"));
				$this->Ln(3);
				$this->Cell(5);
				$this->MultiCell(0,10,utf8_decode("Rubrique Budgétaire:		"));
				$this->Ln(3);
				$this->Cell(5);
				$this->MultiCell(0,10,utf8_decode("Créancier	:		"));
				$this->Ln(3);
				$this->Cell(5);
				$this->MultiCell(0,10,utf8_decode("Pièces Justificatives:		"));
				$this->SetFont('Times','',10);
				$this->Cell(70);
				$this->MultiCell(0,10,utf8_decode("-Etat de prélèvement"));

				$this->setFont('Arial','B',10);
				$this->Cell(5);
				$this->MultiCell(0,0,utf8_decode("Total à payer :				1950.25DH"));
				
				$this->SetFont('Times','B',10);
				$this->Cell(5);
				$this->MultiCell(00,10,utf8_decode("DEUX MILLE SIX CENT VINGT SIX DHS CINQUANTE SIX CENTIMES"));
				$this->MultiCell(0,0,"    TRANSMIS AU TRESORIER PAYEUR                                MODE DE PAIMENT");
				$this->MultiCell(0,0,$this->Rect(10, 215, 90, 7));
				
				$this->Cell(110);
				$this->MultiCell(0,0,$this->Rect(100, 215, 90, 7));
				$this->MultiCell(0,20,utf8_decode("    Date:                                                                                            Date du réglement: "));
				$this->MultiCell(0,0,$this->Rect(10, 215, 90, 50));
				$this->Cell(110);
				$this->MultiCell(0,0,$this->Rect(100, 215, 90, 50));
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
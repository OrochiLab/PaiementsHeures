<?php
		require_once('../pdf/fpdf.php');
		//require_once('../Metier/Etudiant.class.php');
		class PDF_22 extends FPDF
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
			    $this->Cell(130);
			    $this->MultiCell(0,0,$this->Rect($this->getX(), $this->getY(), 30, 7));
			    $this->Ln(6);
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
			function print_certificat($chemin,$a,$b,$c,$d,$e,$f,$montant)
			{
				
				$tab = array('Excercice :  '.$a,'Article :  '.$b,'Paragraphe : '.$c,
							'Ligne :  '.$d,'Rubriques Bugétaires :  '.$e,'Créancier :  '.$f,"Pièces Justificatifs :  ");
				$piece = "-Etat de prélévement" ;
				$this->Ln(2);
				$this->SetFont('Arial','B',10);
				// Instanciation de la classe dérivée
				$this->AliasNbPages();
				$this->AddPage();
				//$this->SetFont('Times','',12);
				$pas=7;
				foreach ($tab as $key ) {
					$this->SetXY(10,115+$pas);
					$this->Cell(0,0,utf8_decode($key));
					$pas=$pas+7;
				}
				$this->SetXY($this->getX()-153,$this->getY());
				$this->SetFont('Times','',10);
				$this->MultiCell(0,5,utf8_decode($piece));
				$this->Ln(5);
				$this->SetFont('Arial','B',10);
				$this->MultiCell(0,5,"Montant de l'ordre de paiement :    TROIS MILLEDEUX CENY QURANTE DHS");
				$this->MultiCell(0,5,utf8_decode("Total à payer:                                      ".$montant));

				$this->MultiCell(0,0,$this->Rect(10, 195, 90, 10));
				$this->SetXY($this->getX()+10,$this->getY()+12);
				$this->SetFont("Times",'BI',13);
				$this->MultiCell(0,5,"TRESORIER TRANSMIS AU");
				$this->SetXY($this->getX()+30,$this->getY()+2);
				$this->MultiCell(0,0,"PAYEUR");
				$this->Cell(110);
				$this->MultiCell(0,0,$this->Rect(100, 195, 90, 10));
				$this->SetXY($this->getX()+110,$this->getY()-7);
				$this->SetFont("Times",'BI',13);
				$this->MultiCell(0,5,"MODE DE PAIEMENTS");
				$this->SetFont('Arial','',12);
				$this->SetXY($this->getX(),$this->getY()+5);
				$this->MultiCell(0,5,"Date : ");
				$this->MultiCell(0,5,"Signature du sous ordonnateur:");
				$this->SetXY($this->getX()+90,$this->getY()-10);
				$this->MultiCell(0,5,utf8_decode("Date du réglement : "));
				$this->SetXY($this->getX()+90,$this->getY());
				$this->MultiCell(0,5,utf8_decode("Visa du Trésorier Payeur"));
				$this->MultiCell(0,0,$this->Rect(10, 205, 90, 50));
				$this->Cell(110);
				$this->MultiCell(0,0,$this->Rect(100, 205, 90, 50));
				$this->Output($chemin,'F');
			}
		}

/*		
	$doc =  new PDF();

	$doc->print_certificat('2010','I','20','10','Heure Supplémentaire','Enseignant');*/		
?>
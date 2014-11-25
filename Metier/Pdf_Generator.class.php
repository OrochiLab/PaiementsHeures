<?php
	/**
	* Class for pdf generation author M.A.Osm
	*/
	require_once('Heures.class.php');
	require_once('Professeur.class.php');
	require_once ('Pdf_1_Vacation.class.php');
	require_once ('Pdf_2_Vacation.class.php');
	require_once ('Pdf_Etat_prelevement_sup.Class.php');
	require_once ('Pdf_Etat_prelevement_vacation.Class.php');
	require_once ('Pdf_Etat_somme_HSup.class.php');
	require_once ('Pdf_Recap.class.php');
	require_once ('Pdf_Recap_vacation.class.php');

	class PdfGenerator 
	{
		private $donnes;
		private $prof;
		private $semestre;
		private $year;
		private $hourtype;
		private $cinProf;
		function __construct($semestre,$year,$hourtype,$cinProf)
		{	
			$this->prof = Professeur::getProfesseur($cinProf);
			$this->donnes = Heures::getBySem($this->prof->getId(),$semestre,$year,$hourtype);
			$this->semestre = $semestre;
			$this->year = $year;
			$this->hourtype = $hourtype;
			$this->cinProf = $cinProf;
		}
		public function getSemestre()
		{
			return $this->semestre;
		}

		public function setSemestre($newSemestre)
		{
			$this->semestre=$newSemestre;
		}

		public function getHourtype()
		{
			return $this->hourtype;
		}

		public function setHourtype($newhourtype)
		{
			$this->hourtype=$newhourtype;
		}

		public function getDonnes()
		{
			return $this->donnes;
		}

		public function getYear()
		{
			return $this->year;
		}

		public function setYear($newYear)
		{
			$this->year=$newYear;
		}
		public function setDonnes($newDonnes)
		{
			$this->donnes=$newDonnes;
		}

		public function getcinProf()
		{
			return $this->cinProf;
		}

		public function setcinProf($newcinProf)
		{
			$this->cinProf=$newcinProf;
		}

		public function getProf()
		{
			return $this->prof;
		}

		public function setProf($newProf)
		{
			$this->prof=$newProf;
		}

		public function generation()
		{
			if($this->getHourtype()=='sup')
			{	
				$Vacation = new PDF_1();
				$Vacation->print_certificat('../Pieces_Justificatifs/Ordres_paiements/Ordres_paiements--Percepteur - '.$this->getcinProf().'--'.$this->getProf()->getNom().'.pdf',$this->getYear(),'I','20','10','Heure Supplémentaire','Enseignant',$montant="9999.99");
				//*****************
				$Etat_prelevement_sup =  new PDF_3();
				$Etat_prelevement_sup->print_certificat('../Pieces_Justificatifs/Etat_de_prelevement_heures_sup/Etat_de_prelevement_heures_sup - '.$this->getcinProf().'--'.$this->getProf()->getNom().'.pdf');
				//*****************
				$data = array("ouasmine","med","amine" ); ;
				$Etat_somme_HSup = new PDF_5();
				$Etat_somme_HSup->FancyTable('../Pieces_Justificatifs/Etat_de_somme_heures_sup/Etat_de_somme_heures_sup - '.$this->getcinProf().'--'.$this->getProf()->getNom().'.pdf',$data);
				//*****************
				$Recap_Sup = new PDF_6();
				$Recap_Sup->FancyTable('../Pieces_Justificatifs/Etat_Recapitulatif_sup/Etat_Recapitulatif_sup - '.$this->getcinProf().'--'.$this->getProf()->getNom().'.pdf',$this->getDonnes(),$this->getProf()->getCin());

			}else{
				//*****************

			}
		}
	}
	$pdf = new PdfGenerator("s1","2014/2015","sup","BK275058");
	
	$pdf->generation();
?>
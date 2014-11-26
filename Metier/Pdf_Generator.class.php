<?php
	/**
	* Class for pdf generation author M.A.Osm
	*/

	class PdfGenerator 
	{
		private $donnes;
		private $prof;
		private $semestre;
		private $year;
		private $hourtype;
		private $cinProf;
		private $frais;
		function __construct($semestre,$year,$hourtype,$cinProf)
		{	
			$this->prof = Professeur::getProfesseur($cinProf);
			$this->donnes = Heures::getBySem($this->prof->getId(),$semestre,$year,$hourtype);
			$this->semestre = $semestre;
			$this->year = $year;
			$this->hourtype = $hourtype;
			$this->cinProf = $cinProf;
			$this->frais = $this->calculs();
		}

		private function calculs()
		{
			$total =0;
			$nbreHeures=0;
			$frais = array();
			for($i=0;$i<count($this->donnes);$i++)
			{
				$nbreHeures += $this->donnes[$i]['total'];
			}
			$frais['nbreHeures'] = $nbreHeures;
			$frais['brut']= $this->prof->getGrade()->getIndemnite()*$nbreHeures;
			if($this->hourtype=='sup')
			{
				$frais['frais_prof'] = $frais['brut']*0.2;
				$frais['imposable'] = $frais['brut']*0.8;
				$frais['impot'] = $frais['brut']*0.8*0.4;
				$frais['net'] = $frais['frais_prof']+($frais['brut']*0.8*0.6);
			}
			else
			{
				$frais['impot'] = $frais['brut']*0.17;
				$frais['net'] =$frais['brut']-$frais['impot'];
			}

			return $frais;
		}


		public function getFrais()
		{
			return $this->frais;
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
				//*****************
				$Sup_prof = new PDF_11();
				$Sup_prof->print_certificat('Pieces_Justificatifs/Ordres_paiements/Ordres_paiements_Prof_sup_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->getYear(),'I','20','20','Heures Supplémentaires',$this->getProf()->getNom().' '.$this->getProf()->getPrenom(),$this->frais);			
				//*****************
				$Sup_perc = new PDF_22();
				$Sup_perc->print_certificat('Pieces_Justificatifs/Ordres_paiements/Ordres_paiements_Percepteur_sup_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->getYear(),'I','20','10','Frais des Heures Supplémentaires','Percepteur de Khouribga',$this->frais);
				//*****************
				$Etat_prelevement_sup =  new PDF_3();
				$Etat_prelevement_sup->print_certificat('Pieces_Justificatifs/Etat_de_prelevement_heures_sup/Etat_de_prelevement_heures_sup_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->frais,$this->year,$this->getProf()->getNom().' '.$this->getProf()->getPrenom());
				//*****************
				$Recap_Sup = new PDF_6();
				$Recap_Sup->FancyTable('Pieces_Justificatifs/Etat_Recapitulatif_sup/Etat_Recapitulatif_sup_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->getDonnes(),$this->getProf()->getCin(),$this->getProf()->getNom().' '.$this->getProf()->getPrenom(),$this->getProf()->getGrade()->getLibelle(),$this->getProf()->getGrade()->getId(),$this->getProf()->getEtablissement()->getLibelle(),$this->getProf()->getSom(),$this->getYear(),$this->getProf()->getSom(),$this->getFrais());

			}else{
				//*****************
				$Vacation_perc = new PDF_1();
				$Vacation_perc->print_certificat('Pieces_Justificatifs/Ordres_paiements/Ordres_paiements_Percepteur_vac_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->getYear(),'I','20','20','Frais Vacation',"Percepeteur de Khouribga",$this->frais);
				//*****************
				$Vacation_prof = new PDF_2();
				$Vacation_prof->print_certificat('Pieces_Justificatifs/Ordres_paiements/Ordres_paiements_Prof_vac_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->getYear(),'I','20','20','Frais Vacation',$this->getProf()->getNom().' '.$this->getProf()->getPrenom(),$this->frais);
				//*****************
				$Recap_Vac = new PDF_7();
				$Recap_Vac->FancyTable('Pieces_Justificatifs/Etat_Recapitulatif_vac/Etat_Recapitulatif_vac_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->getDonnes(),$this->getProf()->getCin(),$this->getProf()->getNom().' '.$this->getProf()->getPrenom(),$this->getProf()->getGrade()->getLibelle(),$this->getProf()->getGrade()->getId(),$this->getProf()->getEtablissement()->getLibelle(),(($this->getProf() instanceof ProfesseurActivite)?$this->getProf()->getSom():'--'),$this->getYear(),(($this->getProf() instanceof ProfesseurActivite)?$this->getProf()->getSom():'--'),$this->getFrais());
				//*****************
				$Etat_prelevement_vac =  new PDF_4();
				$Etat_prelevement_vac->print_certificat('Pieces_Justificatifs/Etat_de_prelevement_heures_vac/Etat_de_prelevement_heures_vac_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->frais,$this->year,$this->getProf()->getNom().' '.$this->getProf()->getPrenom());
				
			}
		}
		public function secretairePdf()
		{
			//*****************
			$Etat_somme_HSup = new PDF_5();
			$Etat_somme_HSup->FancyTable('Pieces_Justificatifs/Etat_de_somme_heures_sup/Etat_de_somme_heures_'.explode('/',$this->getYear())[0].'_'.explode('/',$this->getYear())[1].'_'.$this->getSemestre().'_'.$this->getcinProf().'.pdf',$this->getDonnes(),$this->getProf()->getCin(),$this->getProf()->getNom().' '.$this->getProf()->getPrenom(),$this->getProf()->getGrade()->getLibelle(),$this->getProf()->getGrade()->getId(),$this->getProf()->getEtablissement()->getLibelle(),(($this->getProf() instanceof ProfesseurActivite)?$this->getProf()->getSom():'--'),$this->getYear(),(($this->getProf() instanceof ProfesseurActivite)?$this->getProf()->getSom():'--'),$this->getFrais());
				
		}
	}
	/*$pdf = new PdfGenerator("s1","2014/2015","vac","BK275058");
	
	$pdf->generation();
	$pdf->secretairePdf();*/
?>
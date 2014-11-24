<?php

require_once('Professeur.class.php');
require_once('Etablissement.class.php');


class Heures
{	
	private $id;
	private $date_jour;
	private $nbre_heure;
	private $type;
	private $tranches;
	private $professeur;
	private $etablissement;
	
	
	
	public function __cosntruct($id,$date_jour,$nbre_heure,$type,$tranches,$professeur,$etablissement)
	{
		$this->id = $id;
		$this->date_jour = $date_jour;
		$this->nbre_heure= $nbre_heure;
		$this->type = $type;
		$this->tranches = $tranches;
		$this->professeur = $professeur;
		$this->etablissement = $etablissement;
	
	}
	
	public function setId($id)
	{
	
		$this->id = $id;
	}
	
	public function getId()
	{
		return $this->id;
	
	}
	
	public function setDateJour($date_jour)
	{
		$this->date_jour = $date_jour;
	
	}
	
	public function getDateJour()
	{
		return $this->date_jour;
	}
	
	public function setNbreHeure($nbre_heure)
	{
		$this->nbre_heure = $nbre_heure;
	}
	
	public function getNbreHeure()
	{
		return $this->nbre_heure;
	
	}
	
	public function setType($type)
	{
		$this->type= $type;
	}
	
	public function getType()
	{
		return $this->type;
	
	}
	
	public function setProfesseur(Professeur $professeur)
	{
		$this->professeur=$professeur;
	}
	
	public function getProfesseur()
	{
		return $this->professeur;
	}
	
	
	public function setEtablissement($etablissement)
	{
		$this->etablissement = $etablissement;
	
	}	
	
	public function getEtablissement()
	{
		return $this->etablissement;
	}
	
	public function setTranches($tranches)
	{
		$this->tranches = $tranches;
	}
	
	public function getTranches()
	{
		return $this->tranches;
	}

	public static function enregistrer($date_jour,$nbre_heure,$type,$tranches,$id_prof,$id_etab)
	{
		try{
		$rep = Database::getConnection()->prepare('insert into heures values (null,:date_jour,:nbre_heure,:type,:tranches,:id_prof,:id_etab)');
			if($rep->execute(array(
			'date_jour'=>$date_jour,
			'nbre_heure'=>$nbre_heure,
			'type'=>$type,
			'tranches'=>$tranches,
			'id_prof'=>$id_prof,
			'id_etab'=>$id_etab
			)))
			{
				return 'true';
			}
			else
				return 'false';
		}catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}
	
	public static function getByProf($cin)
	{
		try{
		$tab = array();
		$prof = Professeur::getProfesseur($cin);
		$rep = Database::getConnection()->query('select * from heures h ,professeurs p where h.id_prof=p.id and cin=\''.$cin.'\' order by date_jour desc');
		while($donnes=$rep->fetch())
		{
			$etab =  Etablissement::getEtablissement($donnes['id_eta'])->getLibelle();
			//$tab[] = new Heures($donnes['id'],$donnes['date_jour'],$donnes['nbre_heure'],$donnes['type'],$prof,$etab);
			$tab[] = $donnes['date_jour'].'#'.$donnes['nbre_heure'].'#'.$donnes['type'].'#'.$donnes['tranches'].'#'.$etab;
		}
		return $tab;
		}catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}
}


?>
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
	
	public static function getBySem($id_prof,$sem,$annee_univ,$htype)
	{
		
		try{
		
		
		$tab = array();
		$annee1=explode('/',$annee_univ)[0];
		$annee2=explode('/',$annee_univ)[1];
		
		if($sem=='s1')
		{
			$mois1='9,10,11,12';
			$mois2='1,2';
			$mois3='9,10,11,12,1,2';
			$req='select m.id,libelle as mois,IFNULL(t.annee,IF(m.id IN ('.$mois1.'),'.$annee1.','.$annee2.')) as annee,IFNULL(t.lundi,0) as lundi,IFNULL(t.mardi,0) as mardi,IFNULL(t.mercredi,0) as mercredi,IFNULL(t.jeudi,0) as jeudi,IFNULL(t.vendredi,0) as vendredi,IFNULL(t.samedi,0) as samedi,IFNULL(t.dimanche,0) as dimanche,IFNULL(t.total_mois,0) as total from mois m LEFT OUTER JOIN (select extract(MONTH from date_jour) as mois,extract(YEAR from date_jour) as annee,id_prof,sum(IF(DAYOFWEEK(date_jour)=2,1,0)) as Lundi,sum(IF(DAYOFWEEK(date_jour)=3,1,0)) as Mardi,sum(IF(DAYOFWEEK(date_jour)=4,1,0)) as Mercredi,sum(IF(DAYOFWEEK(date_jour)=5,1,0)) as Jeudi,sum(IF(DAYOFWEEK(date_jour)=6,1,0)) as Vendredi,sum(IF(DAYOFWEEK(date_jour)=7,1,0)) as Samedi,sum(IF(DAYOFWEEK(date_jour)=1,1,0)) as Dimanche, count(date_jour) as total_mois from heures where id_prof='.$id_prof.' and type=\''.$htype.'\' and (extract(YEAR FROM date_jour)='.$annee1.' and extract(MONTH FROM date_jour) IN ('.$mois1.')) or (extract(YEAR FROM date_jour)='.$annee2.' and extract(MONTH FROM date_jour) IN ('.$mois2.')) group by 1,2 order by 2,1) t ON m.id=t.mois where m.id in ('.$mois3.') order by 3,1';
		}
		else	
		{
			$mois='2,3,4,5,6,7';
			$req='select m.id,libelle as mois,IFNULL(t.annee,'.$annee2.') as annee,IFNULL(t.lundi,0) as lundi,IFNULL(t.mardi,0) as mardi,IFNULL(t.mercredi,0) as mercredi,IFNULL(t.jeudi,0) as jeudi,IFNULL(t.vendredi,0) as vendredi,IFNULL(t.samedi,0) as samedi,IFNULL(t.dimanche,0) as dimanche,IFNULL(t.total_mois,0) as total from mois m LEFT OUTER JOIN (select extract(MONTH from date_jour) as mois,extract(YEAR from date_jour) as annee,id_prof,sum(IF(DAYOFWEEK(date_jour)=2,1,0)) as Lundi,sum(IF(DAYOFWEEK(date_jour)=3,1,0)) as Mardi,sum(IF(DAYOFWEEK(date_jour)=4,1,0)) as Mercredi,sum(IF(DAYOFWEEK(date_jour)=5,1,0)) as Jeudi,sum(IF(DAYOFWEEK(date_jour)=6,1,0)) as Vendredi,sum(IF(DAYOFWEEK(date_jour)=7,1,0)) as Samedi,sum(IF(DAYOFWEEK(date_jour)=1,1,0)) as Dimanche, count(date_jour) as total_mois from heures where id_prof='.$id_prof.' and type=\''.$htype.'\' and (extract(YEAR FROM date_jour)='.$annee2.' and extract(MONTH FROM date_jour) IN ('.$mois.')) group by 1,2 order by 2,1) t ON m.id=t.mois where m.id in ('.$mois.') order by 3,1';
		}
		
		$rep = Database::getConnection()->query($req);
		while($donnes=$rep->fetch())
		{
			$tab[] = $donnes;
		}
		return $tab;
		}catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	
	}
}


?>
<?php
require_once('Etablissement.class.php');
require_once('Grade.class.php');
require_once('ProfesseurActivite.class.php');
require_once('Database.class.php');


class Professeur
{
	private $id;
	private $cin;
	private $nom;
	private $prenom;
	private $grade;
	private $etablissement;
	
	
	public function __construct($id,$cin,$nom,$prenom,$grade,$etablissement)
	{
			$this->id = $id;
			$this->cin = $cin;
			$this->nom = $nom;
			$this->prenom = $prenom;
			$this->grade = $grade;
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
	
	public function setCin($cin)
	{
		$this->cin = $cin;
	}
	public function getCin()
	{
		return $this->cin;
	}
	
	public function setNom($nom)
	{
		$this->nom = $nom;
	}
	public function getNom()
	{
		return $this->nom;
	}
	
	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;
	
	}
	
	public function getPrenom()
	{
		return $this->prenom;
	}
	
	public function setGrade(Grade $grade)
	{
		$this->grade = $grade;
	}
	
	public function getGrade()
	{
		return $this->grade;
	}
	
	public function setEtablissement(Etablissement $etablissement)
	{
		$this->etablissement = $etablissement;
	}
	
	public function getEtablissement()
	{
		return $this->etablissement;
	}	
	
	public static function getProfesseur($cin)
	{
		try{
		$prof;
		$rep = Database::getConnection()->query('select p.id,p.cin,p.nom,p.prenom,p.grade,p.id_eta,num_som from professeurs p LEFT OUTER JOIN professeurs_activite pa ON pa.id_prof=p.id where p.cin=\''.$cin.'\'');
		if($donnes=$rep->fetch())
		{
			if(isset($donnes['num_som']))
				$prof = new ProfesseurActivite($donnes['id'],$donnes['cin'],$donnes['nom'],$donnes['prenom'],Grade::getGrade($donnes['grade']),Etablissement::getEtablissement($donnes['id_eta']),$donnes['num_som']);
			else
				$prof = new Professeur($donnes['id'],$donnes['cin'],$donnes['nom'],$donnes['prenom'],Grade::getGrade($donnes['grade']),Etablissement::getEtablissement($donnes['id_eta']));
		
			return $prof;
		}
		else
		{
			return null;
		}
		}catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}

}


?>
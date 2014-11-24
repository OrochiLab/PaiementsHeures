<?php

require_once('Database.class.php');
require_once('Universite.class.php');

class Etablissement
{
	private $id;
	private $libelle;
	private $universite;
	
	public function __construct($id,$libelle,$universite)
	{
		$this->id=$id;
		$this->libelle=$libelle;
		$this->universite = $universite;
	
	}
	
	public function setId($id)
	{
		$this->id = $id;
	
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setLibelle($libelle)
	{
		$this->libelle = $libelle;
	}
	public function getLibelle()
	{
		return $this->libelle;
	}

	public function setUniversite(Universite $universite)
	{
		$this->universite = $universite;
	}
	
	public function getUniversite()
	{
		return $this->universite;
	}
	
	public static function getEtablissement($id_etab)
	{
		$rep = Database::getConnection()->query('select * from etablissements where id='.$id_etab);
		if($donnes=$rep->fetch())
		{
		$etab = new Etablissement($donnes['id'],$donnes['libelle'],Universite::getUniversite($donnes['id_univ']));
		return $etab;
		}
		else
			return null;
	
	}
	
	public static function getAll()
	{
		$tab = array();
		$rep = Database::getConnection()->query('select * from etablissements');
		while($donnes=$rep->fetch())
		{
		$tab[] = new Etablissement($donnes['id'],$donnes['libelle'],Universite::getUniversite($donnes['id_univ']));
		}
		
		return $tab;
	}
}

?>
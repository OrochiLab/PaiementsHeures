<?php
require_once('database.class.php');


class Universite
{
	private $id;
	private $libelle;
	
	
	public function __construct($id,$libelle)
	{
		$this->id=$id;
		$this->libelle=$libelle;
	
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
	
	public static function getUniversite($id_univ)
	{
	
		$rep = Database::getConnection()->query('select * from universite where id='.$id_univ);
		if($donnes=$rep->fetch())
		{
			$univ = new Universite($donnes['id'],$donnes['libelle']);
			return $univ;
		
		}
		else
			return null;
	}

}

?>
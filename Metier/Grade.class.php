<?php

require_once('Database.class.php');

class Grade
{
	private $id;
	private $libelle;
	private $indemnite;
	
	
	
	public function __construct($id,$libelle,$indemnite)
	{
		$this->id = $id;
		$this->libelle = $libelle;
		$this->indemnite = $indemnite;
	
	}
	
	
	public function setId($id)
	{
		$this->id=$id;
	
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
	
	public function setIndemnite($indemnite)
	{
		$this->indemnite = $indemnite;
	
	}
	
	public function getIndemnite()
	{
		return $this->indemnite;
	
	}
	
	public static function getGrade($id_grade)
	{
		$grade;
		$rep = Database::getConnection()->query('select * from grades where id=\''.$id_grade.'\'');
		if($donnes=$rep->fetch())
		{
			$grade = new Grade($donnes['id'],$donnes['libelle'],$donnes['indemnite']);
			return $grade;
		
		}
		
		return null;
	
	}

}

?>
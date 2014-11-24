<?php
require_once('Database.class.php');

class Responsable
{
	private $id;
	private $nom;
	private $prenom;
	private $type;
	
	
	public function __construct($id,$nom,$prenom,$type)
	{
		$this->id= $id;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->type= $type;
	
	}
	
	public function setId($id)
	{
	
		$this->id=$id;
	}
	public function getId()
	{
		return $this->id;
	}
	
	public function setNom($nom)
	{
		$this->nom = $nom;
	
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function setPrenom($renom)
	{
		$this->prenom=$prenom;
	}
	
	public function getPrenom()
	{
	
		return $this->prenom;
	}
	
	public function setType($type)
	{
		$this->type= $type;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public static function getResponsable($login,$password)
	{
		try{
		$rep = Database::getConnection()->query('select * from responsables where id = (select id_resp from logins where login=\''.$login.'\' and password=\''.$password.'\' )');
		if($donnes = $rep->fetch())
		{	
			$resp = new Responsable($donnes['id'],$donnes['nom'],$donnes['prenom'],$donnes['type']);
			return $resp;
		}
		else
			return null;
			
		}catch(Exception $e)
		{
			die ('Erreur : '.$e->getMessage());
		}
	}


}


?>
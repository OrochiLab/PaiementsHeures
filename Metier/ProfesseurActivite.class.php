<?php
require_once('Professeur.class.php');


class ProfesseurActivite extends Professeur
{
	private $som;
	
	public function __construct($id,$cin,$nom,$prenom,$grade,$etablissement,$som)
	{
		parent::__construct($id,$cin,$nom,$prenom,$grade,$etablissement);
		$this->som=$som;
	}

	public function setSom($som)
	{
		$this->som=$som;
	}
	
	public function getSom()
	{
	
		return $this->som;
	}

}


?>
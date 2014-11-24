<?php
class Login
{
	private $id;
	private $login;
	private $password;
	
	
	
	public function __construct($id,$login,$password)
	{
		$this->id= $id;
		$this->login = $login;
		$this->password = $password;
	
	}
	
	
	public function setId($id)
	{
	
		$this->id = $id;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setLogin($login)
	{
		$this->login = $login;
	
	}
	
	public function getlogin()
	{
		return this->login;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	
	}
	
	public function getPassword()
	{
		return $this->password;
	}

}


?>
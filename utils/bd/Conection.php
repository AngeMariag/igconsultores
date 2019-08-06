<?php
namespace utils\bd\bd;
class Conection 
{
	public $host; 
	public $db; 
	public $user; 
	public $pass; 
    public $url; 
    
	private function loadvalue()
	{
		$this->host= DB_HOST;
		$this->db= DB_NAME;
		$this->user= DB_USER;
		$this->pass= DB_PASSWORD;
	}
	function connect()
	{
		$this->loadvalue();
        $this->connect_mysql();
		return true;
	}
	private function connect_mysql()
	{
		$this->url= new \mysqli($this->host, $this->user, $this->pass, $this->db);
		$this->url->set_charset("utf8");	
	}
	function destroy()
	{
        $this->url->close();
	}
	public function getconn()
	{
		if(!$this->connect()){
			$this->connect();			
		}
		return $this->url;  
	}
}
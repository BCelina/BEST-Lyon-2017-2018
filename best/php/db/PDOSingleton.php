<?php
	include_once(__DIR__."/../config.php");

	class PDOSingleton{
		private $pdo;
		
		public function __construct(){
			$this->pdo = null;
		}
		
		public function get_connexion(){
			if(is_null($this->pdo)){
				try{
					$this->pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_LOG, DB_PASS);
				}
				catch(PDOException $e){
					echo "no DB connexion :", $e->getMessage();
	  				die();
				}
			}
			return $this->pdo;
		}
		
		public function __destruct(){
			unset($this->pdo);
		}
	}
?>
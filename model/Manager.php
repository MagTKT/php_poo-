<?php
/* Manager gère ma connexion a ma base de donnée , j’ai fait passer toutes mes entités à cette classe la */	
class Manager{

	protected function dbConnect()
	{

		$host_name = 'db769529361.hosting-data.io';
		$database = 'db769529361';
		$user_name = 'dbo769529361';
		$password = 'Adminadmin';
		
		try {
			$db = new PDO("mysql:host=".$host_name."; dbname=".$database.";", $user_name, $password);
		} 
		catch (PDOException $e) {
			echo "Erreur!: " . $e->getMessage() . "<br/>";
			die();
		}
		return $db;
	}
}
	?>
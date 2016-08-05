<?php
/**
* Simple php class to provide a fast Sqlite3 use
* author: Jhonatan Morais <http://www.getjv.com.br>
* version: 1.0
*/
class MyDB extends SQLite3
{
	/**
	* Set the path to you Sqlite3 database file
	*/
	private  $db_path ;

	
	function __construct($dbPath){

		$this->db_path = $dbPath;
	}


	/**
	* open connection 
	*/
	private function connect(){
		
		try{

			$this->open($this->db_path);

		}catch(Exception $e){

			echo '<pre>',$this->lastErrorMsg(),"<br>";
			throw $e;
			
			
		}



	}

	/**
	* return a array with data from sql statemant.
	*/
	public function execute($sql){
		try{
			$this->connect();
			$result = $this->query($sql)->fetchArray(SQLITE3_ASSOC);
			$this->close();
			return $result;
		}catch(Exception $e){

			
			echo '<pre>',$e->getTraceAsString();
		}

	}

	/**
	* return a json with data from sql statemant or false, if no data.
	*/
	public function getJson($sql){
		
		return json_encode($this->execute($sql));

	}

}


$db = new MyDB('../bd/getForms.db');

echo $db->getJson('select * from surveys');




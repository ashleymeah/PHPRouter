<?php
/**
 * PHPRouter
 *
 * @copyright Ashley Meah (http://ashley.meah.me.uk/)
 * @license   The MIT License (MIT)
 *
 * This source file is subject to the The MIT License (MIT) License that is bundled
 * with this source code in the file LICENSE.md
 */

//Example database repository class
class Repository
{
	protected $PDOHandler;
	
	//connect etc
	public function __construct()
	{
		$connection = "mysql:dbname=appdb;host=127.0.0.1";
		$user = "root";
		$password = "";

		try
		{
			$this->PDOHandler = new PDO($connection, $user, $password);
		}
		catch (PDOException $e)
		{
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
	
	//returns model with initlized params from database
	public function pullModel($model)
	{
		
	}
	
	//updates database with new model params
	public function pushModel($model)
	{
		
	}
}
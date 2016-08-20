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

class Controller
{
	protected $repository;

	public function __construct()
	{
		$this->repository = new Repository;
	}

	//Returns model, you guessed it !
	protected function model($model)
	{
		if(file_exists('application/models/' . $model . '.class.php'))
		{
			require_once('application/models/' . $model . '.class.php');
			return new $model();
		}
		else throw new Exception('MVC Model does not exist');
	}
	
	//This does not just return a view, it accepts data !
	protected function view($view, $data = [])
	{
		if(file_exists('application/views/' . $view . '.phtml'))
		{
			require_once('application/views/' . $view . '.phtml');
		}
		else throw new Exception('MVC View does not exist');
	}
}
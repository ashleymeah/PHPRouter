<?php

class Controller
{	
	protected function model($model)
	{
		if(file_exists('application/models/' . $model . '.class.php'))
		{
			require_once('application/models/' . $model . '.class.php');
			return new $model();
		}
		else throw new Exception('MVC Model does not exist');
	}
	
	protected function view($view, $data = [])
	{
		if(file_exists('application/views/' . $view . '.phtml'))
		{
			require_once('application/views/' . $view . '.phtml');
		}
		else throw new Exception('MVC View does not exist');
	}
}
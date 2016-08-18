<?php

class Controller
{
	protected function model($model)
	{
		require_once('application/models/' . $model . '.class.php');
		return new $model();
	}
	
	protected function view($view, $data = [])
	{
		require_once('application/views/' . $view . '.phtml');
	}
}
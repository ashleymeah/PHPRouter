<?php

class baseApp
{
	protected $controller = "Page";
	protected $method = "index";
	protected $params;
	
	public function __construct()
	{
		//Routing entrance
		if(isset($_GET["url"]))
		{
			$this->parseUrl($_GET["url"]);
		}
		else throw new Exception("mod_rewrite failed to route path to correct path");
		
		//Routing exit, prepare + invoke instance controller
		$this->prepare_controller();
		$this->invoke_controller();
	}
	
	protected function parseUrl($url)
	{
		//ignore index.php from params
		if($url == "index.php")
		{
			$url = "Page/index";
		}
		
		//Split up url to array
		$this->params = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
		
		//Is first element telling us we want a controller?
		if(file_exists('application/controllers/' . $this->params[0] . '.class.php'))
		{
			$this->controller = $this->params[0];
			unset($this->params[0]);
		}
	}
	
	protected function prepare_controller()
	{
		//Require base controller and controller for this instance
		require_once 'application/Controller.class.php';
		require_once('application/controllers/' . $this->controller . '.class.php');
		$this->controller = new $this->controller;
		
		if(isset($this->params[1]))
		{
			//Is second element in params telling us we want a method?
			if(method_exists($this->controller, $this->params[1]))
			{
				$this->method = $this->params[1];
				unset($this->params[1]);
			}		
		}
	}
	
	protected function invoke_controller()
	{
		//Relisting params for passing into method
		$this->params = $this->params ? array_values($this->params) : [];
		
		//All variables should have been valided at parse and prepare, invoke controller method.
		if(method_exists($this->controller, $this->method))
		{
			call_user_func_array([$this->controller, $this->method], $this->params);
		}
		else
		{
			echo "404 - Page not fount";
		}
	}
}
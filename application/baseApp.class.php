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

class baseApp
{
	protected $controller;
	protected $method;
	protected $params;
	
	public function __construct()
	{
		//Route controller
		if(isset($_GET["url"]))
		{
			$this->parseUrl($_GET["url"]);
		}		
		
		if($this->controller == "")
			header("Location: " . "Page/error_404");
		
		//Prepare + invoke instance controller
		$this->prepare_controller();
		$this->invoke_controller();
	}
	
	protected function parseUrl($url)
	{
		//ignore index.php from params
		if($url == "index.php")
		{
			$this->controller = "Page";
			$url = "";
			return;
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
		//Require controller for this instance
		require_once('application/controllers/' . $this->controller . '.class.php');
		
		//Did this actually give us our class?
		if(class_exists($this->controller))
			$this->controller = new $this->controller;
		else
			die("Controller '" . $this->controller . "' is corrupted");
		
		//Is there a second element?
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
		
		//Default method if none specified
		if($this->method == "")
			$this->method = "index";
		
		//All variables should have been valided at parse and prepare, invoke controller method.
		if(method_exists($this->controller, $this->method))
		{
			call_user_func_array([$this->controller, $this->method], $this->params);
		}
		else die($this->method . " does not exist in controller");
	}
}
<?php

class Test extends controller
{
	public function index()
	{
		$invalidModel = $this->model("invalidModel");
		$invalidView = $this->view("invalidView");
	}
}
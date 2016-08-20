<?php

class Page extends Controller
{
	public function index($name = '')
	{	
		$user = $this->model("User");
		$user->name = $name;		
		$this->view('home/index', ['greeting' => $user->greeting(), 'greeting2' => 'hard coded !']);
	}
	
	public function error_404()
	{	
		echo "404 not fount";
	}
}
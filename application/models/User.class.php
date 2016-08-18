<?php

class User
{
	public $name;
	
	public function greeting()
	{
		return 'Welcome back ' . $this->name . '!';
	}
}
<?php

class Article extends Controller
{
	public function index($name = "", $test = "")
	{
		echo "Article : " . $name;
		echo $test;
	}
}
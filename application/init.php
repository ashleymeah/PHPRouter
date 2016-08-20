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

//autoload application classes
spl_autoload_register(
	function ($name)
	{
		if(file_exists('application/' . $name . '.class.php'))
			require_once('application/' . $name . '.class.php');
	}
);

//instantiate MVC
$application = new baseApp;
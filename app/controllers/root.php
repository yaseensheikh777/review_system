<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/

//package - app/controller.php

// sample application class
class root
{

	function main()
	{
		routes::render('root');
	}
	
	function about()
	{
		routes::render('about');
	}
	
	function contact()
	{
		routes::render('contact');
	}

	function error ()
	{
		echo "Page not found";
	}

}


?>

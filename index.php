<?php
/*
** KITE - A NANO PHP MVC FRAMEWORK
** Author - Krishna Teja G S
** website - packetcode.com
*/

//package - index.php
//  Triggering KITE Class


define('DS',DIRECTORY_SEPARATOR);

require_once "lib".DS."routes.php";

$routes = routes::getInstance('routes');
$routes->router();
?>
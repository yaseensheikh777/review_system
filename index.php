<?php

/*
** Review System - Ekomi training assignment
** Author - Muhammad Yaseen
*/

//package - index.php
define('DS',DIRECTORY_SEPARATOR);

require "lib".DS."config.php";

require_once "lib".DS."routes.php";

$routes = routes::getInstance('routes');
$routes->router();


?>
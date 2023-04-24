<?php
if (!defined("INDEX")) die();

if (!empty($_GET['page'])) {
	$page  = $_GET['page'];
	$route = $routes[$page];
} else {
	$page = '';
}

$file  = ROOT . "/pages/" . $page . ".php";

if ($page != '') {
	if (is_file($file)) {
		@include($file);
	} else {
		//@include(ROOT . "/tpl/errors/404.php");
		@include(ROOT . "/pages/404.php");
	}
} else {
	if (!@include(ROOT . "/pages/home.php")) die("Ошибка");
}

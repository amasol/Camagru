<?php
session_start();

//Front controller

//	1. Общие настройки
	ini_set('display_errors', 1);
	error_reporting(E_ALL);



//	2.Подключение файла системы
	define('ROOT', dirname(__FILE__));
	 require_once(ROOT. '/components/Router.php');
	 require_once(ROOT. '/components/Db.php');


//	3.Установка соединения с БД

//	if (isset($_SESSION['log_user'])) {
//		echo "пользователь авторизован";
//		var_dump($_SESSION['log_user']);
//	}


//	4.Вызов Router

// запускаем наш метод Run с котроллера Router
	$router = new Router();
	$router->run();
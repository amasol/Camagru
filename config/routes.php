<?php
	return array (

//		первая часть (user/login) - это строка запроса в URL

		'user/login' => 'user/login',
		'user/signup' => 'user/signup',
		'user/reg/([0-9a-z]+)' => 'user/reg/$1',


		'user/logout' => 'user/logout',
		'user/delete' => 'user/delete',
		'user/edit' => 'user/edit',

		'news/([0-9]+)' => 'news/view/$1',	//	actionView в NewsController
		'news' => 'news/index', //	actionIndex в NewsController

		'main/gallery' => 'main/gallery',
		'main' => 'main/view'

//		'news/([0-9]+)' => 'news/view',
//		'news' => 'news/index', //	actionIndex в NewsController
//		'products' => 'products/list', // 	actionList в ProductControllers


	);
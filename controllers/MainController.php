<?php

include_once ROOT. '/models/Main.php';

class MainController
{
	public function actionView()
	{
		require_once (ROOT. '/views/main/home_page.php');
		return true;
	}

	public function actionGallery()
	{
		require_once (ROOT. '/views/main/gallery.html');
		return true;
	}
}
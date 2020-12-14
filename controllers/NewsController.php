<?php

include_once ROOT. '/models/News.php';

class NewsController
{
	// вывод всех таблиц
	public function actionIndex()
	{
		$newsList = array();
		$newsList = News::getNewsList();

		require_once (ROOT. '/views/news/view.php');
		return true;
	}
	// конкретная 	
	public function actionView($id)
	{
		if ($id) {
			$newsItem = News::getNewsItemById($id);

			echo '<pre>';
			($newsItem);
			echo '</pre>';

			require_once (ROOT. '/views/news/index.php');
		}
		return true;
	}
}
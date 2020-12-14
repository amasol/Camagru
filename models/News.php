<?php

//	Наша модель которая подтягивает БД
class News
{
	public static function getNewsItemById($id)
	{
		$id = intval($id);
		if ($id) {
			$db = Db::getConnection();

			$result = $db->query('SELECT * from news WHERE id=' . $id);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$newsItem = $result->fetch();

			return $newsItem;
		}
	}

	public static function getNewsList()
	{
		$db = Db::getConnection();
		$newsList = array();

		$result = $db->query("SELECT * FROM news");
		$newsList = $result->fetchAll(PDO::FETCH_ASSOC);

		return $newsList;
	}
}
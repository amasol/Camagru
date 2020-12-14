<?php

class User
{
	public function checkLoginPass($login, $pass)
	{
		if ($login == '' && trim($pass == '')) {
			return false;
		} else
			return true;
	}

	public function checkLogin($login)
	{
		if (trim($login == '')) {
			return false;
		} else
			return true;
	}

	public function checkPass($pass)
	{
		if ($pass == '') {
			return false;
		} else
			return true;
	}

	public function checkEmail($email)
	{
		if (trim($email == '')) {
			return false;
		} else
			return true;
	}

	public function checkLoginLong($login)
	{
		if (strlen($login) < 3) {
			return false;
		} else
			return true;
	}
	public function checkPassRepeat($pass_two)
	{
		if ($pass_two == '') {
			return false;
		} else
			return true;
	}

	public function checkPassRepeatFalse($pass, $pass_two)
	{
		if ($pass != $pass_two) {
			return false;
		} else
			return true;
	}

	public function checkPassLong($pass)
	{
		if ((strlen($pass) < 6) || (strlen($pass) > 15)) {
			return false;
		} else
			return true;
	}

	public function checkLoginDB($login)
	{
		$db = Db::getConnection();

		$query_search_login = $db->prepare('SELECT login FROM users WHERE login = :login');

		$query_search_login->execute(['login' => $login]);

		$result_search_login= $query_search_login->fetch(PDO::FETCH_BOUND);
		
		if ($result_search_login === true) {
			return false;
		} else
			return true;
	}

	public function checkLoginDB_two($login)
	{
		$db = Db::getConnection();

		$query_search_login = $db->prepare('SELECT login FROM users WHERE login = :login');

		$query_search_login->execute(['login' => $login]);

		$result_search_login= $query_search_login->fetch(PDO::FETCH_BOUND);

		if ($result_search_login === true) {
			return true;
		} else
			return false;
	}

	public function checkEmailDB($email)
	{
		$db = Db::getConnection();

		$query_search_mail = $db->prepare('SELECT email FROM users WHERE email = :email');

		$query_search_mail->execute(['email' => $email]);

		$result_search_email= $query_search_mail->fetch(PDO::FETCH_BOUND);

		if ($result_search_email === true) {
			return false;
		} else
			return true;
	}

	public function checkPassDB($pass, $login)
	{
		$db = Db::getConnection();

		$query_search_pass = $db->prepare('SELECT pass FROM users WHERE login = :login');

		$query_search_pass->execute([
			'login' => $login
		]);
		$result_search_pass= $query_search_pass->fetch(PDO::FETCH_ASSOC);
		$final_comparison = password_verify($pass, $result_search_pass['pass']);

		if ($final_comparison === true) {
			return true;
		} return false;
	}

	public function saveNewUser($login, $email, $pass)
	{
		$db = Db::getConnection();

		$sql ='INSERT INTO users(login, email, pass, adm, hash_email, act_login) VALUES (:login, :email, :pass, :adm, :hash_email, :act_login)';

		$query = $db->prepare($sql);

		$query->execute([
			'login' => $login,
			'email' => $email,
			'pass' => password_hash($pass, PASSWORD_DEFAULT),
			'adm' => '0',
			'hash_email' => hash('whirlpool', $email),
			'act_login' => '0',
		]);
	}

	public function Reg($active_email)
	{
		$db = Db::getConnection();

		$sql = 'UPDATE users SET act_login = 1 WHERE hash_email = :hash_email';

		$query = $db->prepare($sql);

		$query->execute([
			'hash_email' => $active_email,
		]);
		echo "все окей";
	}

	public function aktivUser($login)
	{
		$db = Db::getConnection();

		$sql = 'SELECT * FROM users WHERE login = :login AND act_login = :act_login';

		$query = $db->prepare($sql);

		$query->execute([
			'login' => $login,
			'act_login' => '1',
		]);

		$result = $query->fetch();

		if ($result)
			return true;

		else {
			$sql = 'SELECT email FROM users WHERE login = :login';

			$query = $db->prepare($sql);
			$query->execute([
				'login' => $login,
			]);

			$result = $query->fetchAll();
			return $result['0']['0'];
		}
	}

	public function deleteUser($login)
	{
		$db = Db::getConnection();

		$sql = 'DELETE FROM users WHERE login = :login';

		$query = $db->prepare($sql);

		$query->execute([
			'login' => $login,
		]);
	}

	public function changeLogin($login, $login_post)
	{
		$db = Db::getConnection();

		$sql = 'UPDATE users SET login = :login_post WHERE login = :login';

		$query = $db->prepare($sql);

		$query->execute([
			'login' => $login,
			'login_post' => $login_post
		]);
		$_SESSION['login'] = $login_post;
	}

	public function changeEmail($email, $email_post)
	{
		$db = Db::getConnection();

		$sql = 'UPDATE users SET email = :email_post WHERE email = :email';

		$query = $db->prepare($sql);

		$query->execute([
			'email' => $email,
			'email_post' => $email_post
		]);
		$_SESSION['email'] = $email_post;
	}

	public function changePass($login, $pass)
	{
		$db = Db::getConnection();

		$sql ='UPDATE users SET pass = :pass WHERE login = :login';

		$query = $db->prepare($sql);

		$query->execute([
			'login' => $login,
			'pass' => password_hash($pass, PASSWORD_DEFAULT),
		]);
	}

	public function getEmail($login)
	{
		$db = Db::getConnection();

		$sql = 'SELECT email FROM users WHERE login = :login';

		$query = $db->prepare($sql);

		$query->execute([
			'login' => $login,
		]);

		$result = $query->fetchAll();
		return $result['0']['0'];
	}
}
<?php

include_once ROOT. '/models/User.php';

class UserController
{
	private $user;

	public function actionLogin()
	{
		$data = $_POST;
		$errors = array();
		$this->user = new User();

		if (isset($data['do_signup'])) {

			if (!$this->user->checkLoginPass($data['login'], $data['password'])) {
				$errors[] = 'Введите свой логин и пароль';
			}

			if (!$this->user->checkLogin($data['login'])) {
				$errors[] = 'Введите логин';
			}

			if (!$this->user->checkPass($data['password'])) {
				$errors[] = 'Введите свой пароль';
			}

			if (!$this->user->checkLoginDB_two($data['login'])) {
				$errors[] = 'Логин введен неверно';
			}

			if (!$this->user->checkPassDB($data['password'], $data['login'])) {
				$errors[] = 'Пароль введен неверно';
			}
			//	не нравится этот костыль
			if ($email = $this->user->aktivUser($data['login'])) {
				;
			} if ($email != '1')
				$errors[] = 'Подтвердите регистрацию на почте '. $email;
		}

		require_once (ROOT. '/views/user/login.php');
		return true;
	}



	public function actionSignup()
	{
		$data = $_POST;
		$errors = array();
		$this->user = new User();

		if (isset($data['do_signup'])) {

			if (!$this->user->checkLogin($data['login'])) {
				$errors[] = 'Введите логин';
			}

			if (!$this->user->checkEmail($data['email'])) {
				$errors[] = 'Введите свой email';
			}

			if (!$this->user->checkPass($data['password'])) {
				$errors[] = 'Введите свой пароль';
			}

			if (!$this->user->checkLoginLong($data['login'])) {
				$errors[] = 'Логин должен быть не меньше 3 символов';
			}

			if (!$this->user->checkPassRepeat($data['password_two'])) {
				$errors[] = 'Введите свой пароль повторно';
			}

			if (!$this->user->checkPassRepeatFalse($data['password'], $data['password_two'])) {
				$errors[] = 'Повторный пароль введен неверно';
			}

			if (!$this->user->checkPassLong($data['password'])) {
				$errors[] = 'Пароль должен быть не меньше 6 и не больше 15 символов';
			}


			if (!$this->user->checkEmailDB($data['email'])) {
				$errors[] = 'Такой email уже существует';
			}

			if (empty($errors)) {
				$this->user->saveNewUser($data['login'], $data['email'], $data['password']);

				mail($data['email'],"Your activation key for internet shop.", 'For activation your account '.$data['login'].'
				follow this link http://localhost:8888/user/reg/' . hash('whirlpool', $data['email']));
				$_SESSION['email'] = $data['email'];
			}
		}

		require_once (ROOT. '/views/user/signup.php');
		return true;
	}

	public function actionReg($active_email)
	{
		$this->user = new User();

		$this->user->Reg($active_email);
		header("Location: /user/login/");
		return true;
	}

	public function actionLogout()
	{
		$_SESSION["action"] = '';
		$_SESSION["email"] = '';
		$_SESSION["login"] = '';
		return true;
	}
	//	удаление профиля.
	public function actionDelete()
	{
		$this->user = new User();

		$this->user->deleteUser($_SESSION['login']);
		header("Location: /user/login/");
		return true;
	}
	//	изменение профиля
	public function actionEdit()
	{
		$errors = array();
		$data = $_POST;

		$this->user = new User;

		if ($_SESSION['login']) {
			//	изменение login
			if (isset($data['do_signup_name'])) {
				if (!$this->user->checkLogin($data['login']))
					$errors[] = 'Введите логин';
				else if (!$this->user->checkLoginLong($data['login']))
					$errors[] = 'Логин должен быть не меньше 3 символов';
				else
					$this->user->changeLogin($_SESSION['login'], $data['login']);
			}
			//	изменение email
			if (isset($data['do_signup_email'])) {
				if (!$this->user->checkEmail($data['email']))
					$errors[] = 'Введите свой email';
				else if (!$this->user->checkEmailDB($data['email']))
					$errors[] = 'Такой email уже существует';
				else {
					$email = $this->user->getEmail($_SESSION['login']);
					$this->user->changeEmail($email, $data['email']);
				}
			}
			//	изменение pass
			if (isset($data['do_signup_pass'])) {
				if (!$this->user->checkPass($data['password']))
					$errors[] = 'Введите свой пароль';
				else if (!$this->user->checkPassRepeat($data['password_two']))
					$errors[] = 'Введите свой пароль повторно';
				else if (!$this->user->checkPassRepeatFalse($data['password'], $data['password_two']))
					$errors[] = 'Повторный пароль введен неверно';
				else if (!$this->user->checkPassLong($data['password']))
					$errors[] = 'Пароль должен быть не меньше 6 и не больше 15 символов';
				else
					$this->user->changePass($_SESSION['login'], $data['password']);
			}
		}

		require_once (ROOT. '/views/user/edit.php');
		return true;
	}
}

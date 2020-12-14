<?php

//	 для запоминания что юзер зашел.
if (empty($errors) && isset($_POST['do_signup'])) {
	$_SESSION['action'] = 1;
	$_SESSION['login'] = $_POST['login'];
//	var_dump($_SESSION);
	echo '<div style="color: green;">' . '<strong>Добро пожаловать</strong>' . '</div>';

//	если изменить ПОРТ, ломается ломается абсолютный путь!!!!!
	header('Refresh: 1; URL=http://localhost:8080/main/view');
	exit;

} else
	echo '<div style="color: red;">' . array_shift($errors) . '</div>' . header_remove();
//print_r($_SESSION);
?>


<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="../../template/css/style_login.css" />
</head>
<body>
	<div class="container">
		<section id="content">
			<form method="post">
				<h1>Login Form</h1>
				<div>
<!--						<input type="text" placeholder="Username" required="" id="username" />-->
					<input type="text" placeholder="Username" name="login" value="<?php echo @$data['login']?>">
				</div>
				<div>
<!--						<input type="password" placeholder="Password" required="" id="password" />-->
					<input type="password" placeholder="Password" name="password" value="<?php echo @$data['password']?>">
				</div>
				<div>
					<input type="submit" value="Log in" name="do_signup">
					<a href="#">Lost your password?</a>
					<a href="/user/signup">Register</a>
				</div>
			</form>

		</section>
	</div>
</body>
</html>
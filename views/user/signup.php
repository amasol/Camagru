<?php
// если я не сделал logaut то я не могу зарегатся !!!
if (empty($errors) && isset($_POST['do_signup'])) {
	echo '<div style="color: green;">' . '<strong>Вы зарегистрированы, подтвердите свой email на почте.</strong>' . '</div>';
} else
	echo '<div style="color: red;">' . array_shift($errors) . '</div>' . header_remove();
?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>Signup Form</title>
	<link rel="stylesheet" type="text/css" href="../../template/css/style_login.css" />
</head>
<body>
<div class="container">
	<section id="content">
		<form method="post">
			<h1>Signup Form</h1>
			<div>
				<input type="text" placeholder="UserName" name="login" value="<?php echo @$data['login']?>">
			</div>

			<div>
				<input type="text" placeholder="UserEmail" name="email" value="<?php echo @$data['email']?>">
			</div>

			<div>
				<input type="password" placeholder="UserPass" name="password" value="<?php echo @$data['password']?>">
			</div>

			<div>
				<input type="password" placeholder="UserPass" name="password_two" value="<?php echo @$data['password_two']?>">
			</div>

			<div>
				<input type="submit" value="Register" name="do_signup" >
				<a href="#">Lost your password?</a>
			</div>
		</form>

	</section>
</div>
</body>
</html>
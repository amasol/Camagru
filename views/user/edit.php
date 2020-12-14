<?php

//	if (empty($errors) && isset($_POST['do_signup_name']))  {
if (empty($errors) && (isset($_POST['do_signup_name']) || isset($_POST['do_signup_email']) || isset($_POST['do_signup_pass']))) {
//		echo '<div style="color: red;">' . array_shift($errors) . '</div>' . header_remove();
//	echo "Все ок";
//	if (isset($_POST['do_signup_name'])) {
//		$this->user->changeLogin();
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
				<h1>Change data</h1>
				<div>
					<input type="text" placeholder="UserName" name="login" value="">
				</div>

				<div>
					<input type="submit" value="Change name" name="do_signup_name" >
				</div>

				<div>
					<input type="text" placeholder="UserEmail" name="email" value="">
				</div>

				<div>
					<input type="submit" value="Change email" name="do_signup_email" >
				</div>

				<div>
					<input type="password" placeholder="UserPass" name="password" value="">
				</div>

				<div>
					<input type="password" placeholder="UserPass" name="password_two" value="">
				</div>

				<div>
					<input type="submit" value="Change pass" name="do_signup_pass" >
				</div>
			</form>

		</section>
	</div>
</body>
</html>
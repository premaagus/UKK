<?php 
	require_once './helper/login.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>

	<div class="wrapper">
		<div class="container-left"></div>
		<div class="container-right">
			<div class="container-login">
				<div class="logo">
					<img src="./images/logo.png">
				</div>
				<h1>Global Electric</h1>

				<form action="login-process.php" method="POST">
					<div class="form-control">
						<div class="label">Username</div>
						<div class="form">
							<input type="text" name="Username" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Password</div>
						<div class="form">
							<input type="password" name="Password" required>
						</div>
					</div>
					<div class="button-login">
						<button type="submit" name="btn_submit">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>
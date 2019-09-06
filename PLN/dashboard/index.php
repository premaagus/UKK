<?php 
	require_once '../config/conn.php';
	require_once '../helper/alert.php';
	if (!isset($_SESSION['Level'])) {
		alert('Anda Tidak Memiliki Akses', '../index.php', 'error');
		die();
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
</head>
<body>
	<div class="wrapper">
		<div class="left-menu">
			<div class="logo">
				<img src="../images/logo.png">
			</div>
			<h3>Global Electric</h3>

			<div class="menu-list">
				<ul>
					<li><a class="active" href="#">Dashboard</a></li>
					<li><a href="../modules/tagihan/index.php">Tagihan</a></li>
					<li><a href="../modules/pembayaran/index.php">Pembayaran</a></li>
					<?php 
						if ($_SESSION['Level'] == 'Admin') {
							?>
							<li><a href="../modules/user/index.php">User</a></li>
							<li><a href="../modules/tarif/index.php">Tarif</a></li>
							<li><a href="../modules/pelanggan/index.php">Pelanggan</a></li>
							<?php
						}
					 ?>
					 <li><a href="../logout.php">Logout</a></li>
				</ul>
			</div>
		</div>

		<div class="content"></div>
	</div>
</body>
</html>
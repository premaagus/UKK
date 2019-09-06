<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/admin.php';

	if (!isset($_GET['id'])) {
		header('location: ./index.php');
	}

	$id = $_GET['id'];
	$queryCheck = "SELECT * FROM tblogin WHERE KodeLogin = '$id'";
	$queryCheck = $conn->query($queryCheck);

	if ($queryCheck->num_rows == 1) {
		$data = $queryCheck->fetch_assoc();
	}
	else{
		alert('Data Tidak Ada', './index.php', 'error');
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Edit User</title>
 	<link rel="stylesheet" type="text/css" href="../../css/dashboard.css">
 </head>
 <body>
 
 	<div class="wrapper">
 		<div class="left-menu">
			<div class="logo">
				<img src="../../images/logo.png">
			</div>
			<h3>Global Electric</h3>

			<div class="menu-list">
				<ul>
					<li><a href="../../dashboard/index.php">Dashboard</a></li>
					<li><a href="../tagihan/index.php">Tagihan</a></li>
					<li><a href="../pembayaran/index.php">Pembayaran</a></li>
					<?php 
						if ($_SESSION['Level'] == 'Admin') {
							?>
							<li><a class="active" href="../user/index.php">User</a></li>
							<li><a href="../tarif/index.php">Tarif</a></li>
							<li><a href="../pelanggan/index.php">Pelanggan</a></li>
							<?php
						}
					 ?>
					 <li><a href="../../logout.php">Logout</a></li>
				</ul>
			</div>
		</div>

		<div class="space"></div>

		<div class="content">
			<h1>Edit User</h1>
		 	<hr>

		 	<form action="./process/edit-process.php" method="POST">
		 		<input type="hidden" name="KodeLogin" value="<?= $data['KodeLogin'] ?>">
		 		<div class="container-form">
		 			<div class="form-control">
						<div class="label">Username</div>
						<div class="form">
							<input type="text" name="Username" value="<?= $data['Username'] ?>" required disabled>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Password</div>
						<div class="form">
							<input type="password" name="Password">
						</div>
					</div>
					<div class="form-control">
						<div class="label">Nama Lengkap</div>
						<div class="form">
							<input type="text" name="NamaLengkap" value="<?= $data['NamaLengkap'] ?>" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Level</div>
						<div class="form">
							<select name="Level">
			 					<option <?= ($data['Level'] == 'Admin')? 'selected': '' ?> value="Admin">Admin</option>
			 					<option <?= ($data['Level'] == 'Operator')? 'selected': '' ?> value="Operator">Operator</option>
			 					<option <?= ($data['Level'] == 'Customer')? 'selected': '' ?> value="Customer">Customer</option>
			 				</select>
						</div>
					</div>
					<div class="btn btn-submit">
						<button type="submit" name="btn_submit">Edit</button>
					</div>
		 		</div>
		 	</form>
		</div>

	</div>

 </body>
 </html>
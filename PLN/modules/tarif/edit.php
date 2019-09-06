<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/admin.php';

	if (!isset($_GET['id'])) {
		header('location: ./index.php');
	}

	$id = $_GET['id'];
	$queryCheck = "SELECT * FROM tbtarif WHERE KodeTarif = '$id'";
	$queryCheck = $conn->query($queryCheck);

	if ($queryCheck->num_rows == 1) {
		$data = $queryCheck->fetch_assoc();
	}
	else{
		alert('Data Tidak Ada', './index.php', 'error');
	}
 ?>

 <?php 
	require_once '../../config/conn.php';
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Edit Tarif</title>
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
							<li><a href="../user/index.php">User</a></li>
							<li><a class="active" href="../tarif/index.php">Tarif</a></li>
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
 			<h1>Edit Tarif</h1>
		 	<a href="../../dashboard/index.php">Dashboard</a>
		 	<hr>

		 	<form action="./process/edit-process.php" method="POST">
		 		<input type="hidden" name="KodeTarif" value="<?= $data['KodeTarif'] ?>">
		 		<div class="container-form">
		 			<div class="form-control">
						<div class="label">Daya</div>
						<div class="form">
							<input type="number" name="Daya" value="<?= $data['Daya'] ?>" min="1" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Tarif / Kwh</div>
						<div class="form">
							<input type="number" name="TarifPerKwh" value="<?= $data['TarifPerKwh'] ?>" min="1" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Beban</div>
						<div class="form">
							<input type="number" name="Beban" value="<?= $data['Beban'] ?>" min="1" required>
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
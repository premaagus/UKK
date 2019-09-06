<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/admin.php';

	if (!isset($_GET['id'])) {
		header('location: ./index.php');
	}

	$id = $_GET['id'];
	$queryCheck = "SELECT * FROM tbpelanggan WHERE KodePelanggan = '$id'";
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
 	<title>Edit Pelanggan</title>
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
							<li><a href="../tarif/index.php">Tarif</a></li>
							<li><a class="active" href="../pelanggan/index.php">Pelanggan</a></li>
							<?php
						}
					 ?>
					 <li><a href="../logout.php">Logout</a></li>
				</ul>
			</div>
		</div>

		<div class="space"></div>

		<div class="content">
			<h1>Edit Pelanggan</h1>
		 	<hr>

		 	<form action="./process/edit-process.php" method="POST">
		 		<input type="hidden" name="KodePelanggan" value="<?= $data['KodePelanggan'] ?>">
		 		<div class="container-form">
		 			<div class="form-control">
						<div class="label">No Pelanggan</div>
						<div class="form">
							<input type="number" name="NoPelanggan" min="1" value="<?= $data['NoPelanggan'] ?>" disabled required>
						</div>
					</div>
		 			<div class="form-control">
						<div class="label">No Meter</div>
						<div class="form">
							<input type="number" name="NoMeter" min="1" value="<?= $data['NoMeter'] ?>" disabled required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Daya - Tarif</div>
						<div class="form">
							<select name="KodeTarif">
			 					<?php 
			 						$queryTarif = "SELECT * FROM tbtarif ORDER BY Daya DESC";
			 						$queryTarif = $conn->query($queryTarif);

			 						while ($dataTarif = $queryTarif->fetch_assoc()) {
			 							?>
			 							<option <?= ($data['KodeTarif'] == $dataTarif['KodeTarif'])?'selected':'' ?> value="<?= $dataTarif['KodeTarif'] ?>"><?= number_format($dataTarif['Daya']) ?> VA - Rp. <?= number_format($dataTarif['TarifPerKwh']) ?></option>
			 							<?php
			 						}
			 					 ?>
			 				</select>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Nama Lengkap</div>
						<div class="form">
							<input type="text" name="NamaLengkap" min="1" value="<?= $data['NamaLengkap'] ?>" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Telepon</div>
						<div class="form">
							<input type="number" name="Telp" min="1" value="<?= $data['Telp'] ?>" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Alamat</div>
						<div class="form">
							<textarea rows="5" name="Alamat"><?= $data['Alamat'] ?></textarea>
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
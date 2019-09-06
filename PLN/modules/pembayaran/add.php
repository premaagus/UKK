<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/operator.php';

	if (!isset($_GET['NoTagihan'])) {
		header('location: ./index.php');
	}
	$NoTagihan = $_GET['NoTagihan'];
	$queryCheck = "SELECT * FROM tbtagihan JOIN tbpelanggan USING(KodePelanggan) WHERE NoTagihan = '$NoTagihan'";
	$queryCheck = $conn->query($queryCheck);
	if ($queryCheck->num_rows == 0) {
		alert('Data Tidak Ada', './index.php', 'error');
	}
	else{
		$dataTagihan = $queryCheck->fetch_assoc();
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Search</title>
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
					<li><a class="active" href="../pembayaran/index.php">Pembayaran</a></li>
					<?php 
						if ($_SESSION['Level'] == 'Admin') {
							?>
							<li><a href="../user/index.php">User</a></li>
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
			
			<h1>Add pembayaran</h1>
		 	<hr>

		 	<form action="./process/add-process.php" method="POST" enctype="multipart/form-data">
		 		<input type="hidden" name="KodeTagihan" value="<?= $dataTagihan['KodeTagihan'] ?>">
		 		<div class="container-form">
		 			<div class="form-control">
						<div class="label">No Tagihan</div>
						<div class="form">
							<input type="text" disabled value="<?= $dataTagihan['NoTagihan'] ?>">
						</div>
					</div>
					<div class="form-control">
						<div class="label">Nama Cust</div>
						<div class="form">
							<input type="text" disabled value="<?= $dataTagihan['NamaLengkap'] ?>">
						</div>
					</div>
					<div class="form-control">
						<div class="label">Tanggal Pencatatan</div>
						<div class="form">
							<input type="text" disabled value="<?= date('d-M-Y', strtotime($dataTagihan['TglPencatatan'])) ?>">
						</div>
					</div>
					<div class="form-control">
						<div class="label">Total Bayar</div>
						<div class="form">
							<input type="text" disabled value="Rp. <?= number_format($dataTagihan['TotalBayar']) ?>">
						</div>
					</div>
					<div class="form-control">
						<div class="label">Bukti Pembayaran</div>
						<div class="form">
							<input type="file" name="Invoice" required>
						</div>
					</div>
					<?php 
			 			if ($_SESSION['Level'] == 'Admin') {
			 				?>
			 				<div class="form-control">
								<div class="label">Status</div>
								<div class="form">
									<select name="Status">
					 					<option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
					 					<option value="Lunas">Lunas</option>
					 				</select>
								</div>
							</div>
			 				<?php
			 			}
			 		 ?>
					<div class="btn btn-submit">
						<button type="submit" name="btn_submit">Tambah</button>
					</div>
		 		</div>
		 	</form>

		</div>
	</div>

 </body>
 </html>
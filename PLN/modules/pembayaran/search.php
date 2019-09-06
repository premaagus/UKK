<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/operator.php';

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
			<h1>Search Tagihan</h1>
		 	<hr>

		 	<form action="./add.php" method="GET">
		 		<div class="container-form">
					<div class="form-control">
						<div class="label">No Tagihan - Nama</div>
						<div class="form">
							<select name="NoTagihan">
			 					<?php 
			 						$queryTagihan = "SELECT * FROM tbtagihan JOIN tbpelanggan USING(KodePelanggan) WHERE Status = 'Belum'";
			 						$queryTagihan = $conn->query($queryTagihan);
			 						while ($dataTagihan = $queryTagihan->fetch_assoc()) {
			 							?>
			 							<option value="<?= $dataTagihan['NoTagihan'] ?>"><?= $dataTagihan['NoTagihan'] ?> - <?= $dataTagihan['NamaLengkap'] ?></option>
			 							<?php
			 						}
			 					 ?>
			 				</select>
						</div>
					</div>
					<div class="btn btn-submit">
						<button type="submit">Cari</button>
					</div>
		 		</div>
		 	</form>
		</div>
	</div>

 </body>
 </html>
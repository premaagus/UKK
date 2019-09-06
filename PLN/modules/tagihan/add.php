<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/helper.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/operator.php';


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add Tagihan</title>
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
					<li><a class="active" href="../tagihan/index.php">Tagihan</a></li>
					<li><a href="../pembayaran/index.php">Pembayaran</a></li>
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
			
			<h1>Add Tarif</h1>
		 	<hr>

		 	<form action="./process/add-process.php" method="POST">
		 		<div class="container-form">
		 			<div class="form-control">
						<div class="label">Pelanggan</div>
						<div class="form">
							<select name="KodePelanggan">
			 					<?php 
					 				$queryPelanggan = "SELECT * FROM tbpelanggan";
					 				$queryPelanggan = $conn->query($queryPelanggan);

					 				while ($dataPelanggan = $queryPelanggan->fetch_assoc()) {
					 					?>
					 					<option value="<?= $dataPelanggan['KodePelanggan'] ?>"><?= $dataPelanggan['NamaLengkap'] ?> - <?= $dataPelanggan['NoPelanggan'] ?></option>
					 					<?php
					 				}
					 				 ?>
			 				</select>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Tahun</div>
						<div class="form">
							<select name="TahunTagih">
			 					<option value="2019">2019</option>
			 					<option value="2018">2018</option>
			 					<option value="2017">2017</option>
			 				</select>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Bulan</div>
						<div class="form">
							<select name="BulanTagih">
			 					<?php 
			 					for ($i=1; $i <= 12 ; $i++) { 
			 						?>
			 						<option value="<?= $i ?>"><?= getBulan($i) ?></option>
			 						<?php
			 					}
			 					 ?>
			 				</select>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Total Pemakaian (Kwh)</div>
						<div class="form">
							<input type="number" name="TotalPemakaian" required min="1" style="width: 25%">
						</div>
					</div>
					<div class="form-control">
						<div class="label">Info</div>
						<div class="form">
							<textarea rows="5" name="Keterangan" style="width: 25%"></textarea>
						</div>
					</div>
					<div class="btn btn-submit">
						<button type="submit" name="btn_submit">Tambah</button>
					</div>


		 		</div>
		 	</form>

		</div>
	</div>

 </body>
 </html>
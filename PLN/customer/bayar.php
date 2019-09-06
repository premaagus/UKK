<?php 
	require_once '../config/conn.php';
	require_once '../helper/alert.php';

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
 </head>
 <body>
 
 	<h1>Add pembayaran</h1>
 	<a href="../../dashboard/index.php">Dashboard</a>
 	<hr>

 	<form action="./process/add-process.php" method="POST" enctype="multipart/form-data">
 		<input type="hidden" name="KodeTagihan" value="<?= $dataTagihan['KodeTagihan'] ?>">
 		<table>
	 		<tr>
	 			<td>No Tagihan</td>
	 			<td><input type="text" disabled value="<?= $dataTagihan['NoTagihan'] ?>"></td>
	 		</tr>
	 		<tr>
	 			<td>Nama Cust</td>
	 			<td><input type="text" disabled value="<?= $dataTagihan['NamaLengkap'] ?>"></td>
	 		</tr>
	 		<tr>
	 			<td>Tanggal Pencatatan</td>
	 			<td><input type="text" disabled value="<?= date('d-M-Y', strtotime($dataTagihan['TglPencatatan'])) ?>"></td>
	 		</tr>
	 		<tr>
	 			<td>Total Bayar</td>
	 			<td><input type="text" disabled value="Rp. <?= number_format($dataTagihan['TotalBayar']) ?>"></td>
	 		</tr>
	 		<tr>
	 			<td>Bukti Pembayaran</td>
	 			<td><input type="file" name="Invoice" required></td>
	 		</tr>
	 		<?php 
	 			if ($_SESSION['Level'] == 'Admin') {
	 				?>
	 				<tr>
			 			<td>Status</td>
			 			<td>
			 				<select name="Status">
			 					<option value="Belum Dikonfirmasi">Belum Dikonfirmasi</option>
			 					<option value="Lunas">Lunas</option>
			 				</select>
			 			</td>
			 		</tr>
	 				<?php
	 			}
	 		 ?>
	 		<tr>
	 			<td><button type="submit" name="btn_submit">Tambah</button></td>
	 		</tr>
	 	</table>
 	</form>

 </body>
 </html>
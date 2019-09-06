<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/admin.php';

	$KodeTarif = $_SESSION['print']['KodeTarif'];
	$queryTarif = "SELECT * FROM tbtarif WHERE KodeTarif = $KodeTarif";
	$queryTarif = $conn->query($queryTarif);
	$data = $queryTarif->fetch_assoc();
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Print Bukti</title>
	<style type="text/css">
		@media Print{
			button{
				display: none;
			}
		}
	</style>
</head>
<body>
	<h1 align="center">Bukti Pendaftaran Pelanggan</h1>
	<p align="center"><b>No Meter: <?= $_SESSION['print']['noMeter'] ?></b></p>
	<table align="center" border="1" cellpadding="10" style="border-collapse: collapse;">
		<tr>
			<td>No Pelanggan / Username</td>
			<td>:</td>
			<td><?= $_SESSION['print']['username'] ?></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><?= $_SESSION['print']['password'] ?></td>
		</tr>
		<tr>
			<td>Nama Pelanggan</td>
			<td>:</td>
			<td><?= $_SESSION['print']['namaLengkap'] ?></td>
		</tr>
		<tr>
			<td>Daya - Tarif</td>
			<td>:</td>
			<td><?= number_format($data['Daya']) ?> VA - Rp. <?= number_format($data['TarifPerKwh']) ?></td>
		</tr>
		<tr>
			<td>Telepon</td>
			<td>:</td>
			<td><?= $_SESSION['print']['telp'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?= $_SESSION['print']['alamat'] ?></td>
		</tr>
	</table>

	<div style="text-align: center; margin-top: 20px">
		<button onclick="window.print()">Print</button>
		<button onclick="location.href = './index.php'">Kembali</button>
	</div>
</body>
</html>
<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/helper.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/operator.php';


	$NoTagihan = $_GET['NoTagihan'];
	$queryTagihan = "SELECT * FROM tbtagihan 
						JOIN tbpelanggan USING(KodePelanggan) 
						JOIN tbpembayaran USING(KodeTagihan) 
						JOIN tbtarif USING(KodeTarif) 
						WHERE NoTagihan = '$NoTagihan'";
	$queryTagihan = $conn->query($queryTagihan);
	if ($queryTagihan->num_rows == 1) {
		$data = $queryTagihan->fetch_assoc();
	}
	else{
		alert('Data Tidak Ditemukan', './index.php', 'error');
		die();
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Print Nota</title>
	<style type="text/css">
		@media Print{
			button{
				display: none;
			}
		}
	</style>
</head>
<body>
	<h1 align="center">Nota Lunas</h1>
	<p align="center"><b>No Tagihan: <?= $data['NoTagihan'] ?></b></p>
	<table align="center" border="1" cellpadding="10" style="border-collapse: collapse;">
		<tr>
			<td>No Pelanggan</td>
			<td>:</td>
			<td><?= $data['NoPelanggan'] ?></td>
		</tr>
		<tr>
			<td>Nama Pelanggan</td>
			<td>:</td>
			<td><?= $data['NamaLengkap'] ?></td>
		</tr>
		<tr>
			<td>Pembayaran Untuk</td>
			<td>:</td>
			<td><?= getBulan($data['BulanTagih']) ?>, <?= $data['TahunTagih'] ?></td>
		</tr>
		<tr>
			<td>Tanggal Bayar</td>
			<td>:</td>
			<td><?= date('d-M-Y', strtotime($data['TglBayar'])) ?></td>
		</tr>
		<tr>
			<td>Jumlah Pemakaian</td>
			<td>:</td>
			<td><?= number_format($data['TotalPemakaian']) ?> Kwh</td>
		</tr>
		<tr>
			<td>Beban</td>
			<td>:</td>
			<td>Rp. <?= number_format($data['Beban']) ?></td>
		</tr>
		<tr>
			<td>Total Bayar</td>
			<td>:</td>
			<td>Rp. <?= number_format($data['TotalBayar']) ?></td>
		</tr>
	</table>
	<p align="center">Terima Kasih telah membayar listrik tepat waktu</p>

	<div style="text-align: center; margin-top: 20px">
		<button onclick="window.print()">Print</button>
		<button onclick="location.href = './index.php'">Kembali</button>
	</div>
</body>
</html>
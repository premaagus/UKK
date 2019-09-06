<?php 
	require_once '../config/conn.php';
	require_once '../helper/helper.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tagihan</title>
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/customer.css">
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
					<li><a class="active" href="../../dashboard/index.php">Dashboard</a></li>
					<li><a href="./tagihan.php">Tagihan</a></li>
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

			<h1>List Tagihan</h1>
			<hr>
			<div class="table-control">
				<table cellpadding="10" style="border-collapse: collapse; width: 125%">
					<tr>
						<th>No</th>
						<th>No Tagihan</th>
						<th>No Pelanggan - Nama</th>
						<th>Tahun - Bulan</th>
						<th>Tenggang Pembayaran</th>
						<th>Total Pemakaian (Kwh)</th>
						<th>Total Bayar</th>
						<th>Bukti Pembayaran</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php 
						$queryList = "SELECT *, a.Status AS StatusTagihan FROM tbtagihan AS a JOIN tbpelanggan AS b ON a.KodePelanggan = b.KodePelanggan LEFT JOIN tbpembayaran USING(KodeTagihan) WHERE b.NoPelanggan = $_SESSION[Username] ORDER BY KodeTagihan DESC";
						$queryList = $conn->query($queryList);
						$no = 1;

						while ($data = $queryList->fetch_assoc()) {
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $data['NoTagihan'] ?></td>
								<td><?= $data['NoPelanggan'] ?> - <?= $data['NamaLengkap'] ?></td>
								<td><?= getBulan($data['BulanTagih']) ?>, <?= $data['TahunTagih'] ?></td>
								<td><?= date('d-M-Y', strtotime($data['TglPencatatan']."+1 day")) ?> s/d <?= date('d-M-Y', strtotime($data['TglPencatatan']."+ 5 day")) ?></td>
								<td><?= number_format($data['TotalPemakaian']) ?> Kwh</td>
								<td>Rp. <?= number_format($data['TotalBayar']) ?></td>
								<td>
									<?php 
										if (empty($data['BuktiPembayaran'])) {
											'-';
										}
										else{
											?>
											<img width="100px" src="../uploads/invoice/<?= $data['BuktiPembayaran'] ?>">
											<?php
										}
									 ?>
								</td>
								<td><?= $data['StatusTagihan'] ?></td>
								<td>
									<?php 
									if ($data['StatusTagihan'] == 'Belum') {
										?>
										<div class="btn btn-edit">
											<a href="print.php?NoTagihan=<?= $data['NoTagihan'] ?>">Print</a>
										</div> 
										<div class="btn btn-info">
											<a href="bayar.php?NoTagihan=<?= $data['NoTagihan'] ?>">Bayar</a>
										</div> 
										<?php
										if ($_SESSION['Level'] == 'Admin') {
											?>
											<a href="delete.php?id=<?= $data['KodeTagihan'] ?>">Delete</a>
											<?php
										}
									}
									else if ($data['Status'] == 'Lunas') {
										?>
										<div class="btn btn-edit">
											<a href="print.php?NoTagihan=<?= $data['NoTagihan'] ?>">Print</a>
										</div> 
										<?php
									}
									else{
										echo "-";
									}
									 ?>
								</td>
							</tr>
							<?php
							$no++;
						}
					 ?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/operator.php';

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
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
			
			<h1>Pembayaran</h1>
			<hr>

			<div class="btn-add btn-info" style="width: 150px;">
				<a href="search.php">Add Pembayaran</a>
			</div>
			
			<div class="table-control">
				<table cellpadding="10" style="border-collapse: collapse;">
					<tr>
						<th>No</th>
						<th>No Tagihan</th>
						<th>Nama Cust. - No Cust.</th>
						<th>Tanggal Bayar</th>
						<th>Total Bayar</th>
						<th>Bukti Pembayaran</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php 
						$queryList = "SELECT *, a.Status AS PembayaranStatus FROM tbpembayaran AS a JOIN tbtagihan AS b ON a.KodeTagihan = b.KodeTagihan JOIN tbpelanggan AS c ON b.KodePelanggan = c.KodePelanggan";
						$queryList = $conn->query($queryList);
						$no = 1;
						while ($data = $queryList->fetch_assoc()) {
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $data['NoTagihan'] ?></td>
								<td><?= $data['NamaLengkap']  ?> - <?= $data['NoPelanggan'] ?></td>
								<td><?= date('d-M-Y', strtotime($data['TglBayar'])) ?></td>
								<td>Rp. <?= number_format($data['TotalBayar']) ?></td>
								<td><img width="100px" src="../../uploads/invoice/<?= $data['BuktiPembayaran'] ?>"></td>
								<td><?= $data['PembayaranStatus'] ?></td>
								<td>
									<?php 
										if ($data['PembayaranStatus'] == 'Lunas') {
											?>
											<div class="btn btn-edit">
												<a href="print.php?NoTagihan=<?= $data['NoTagihan'] ?>">Print</a>
											</div>
											<?php
										}
										else if ($data['PembayaranStatus'] == 'Belum Dikonfirmasi') {
											if ($_SESSION['Level'] == 'Admin') {
												?>
												<div class="btn btn-info" style="width: 85px">
													<a href="konfirmasi.php?id=<?= $data['KodeTagihan'] ?>">Konfirmasi</a>
												</div>
												<?php
											}
											else{
												echo "-";
											}
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
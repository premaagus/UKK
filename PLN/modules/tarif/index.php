<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/admin.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>tarif</title>
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
			<h1>Tarif</h1>
			<hr>

			<div class="btn-add btn-info">
				<a href="add.php">Add Tarif</a>
			</div>
			<div class="table-control">
				<table cellpadding="10" style="border-collapse: collapse;">
					<tr>
						<th>No</th>
						<th>Daya</th>
						<th>Tarif / Kwh</th>
						<th>Beban</th>
						<th>Action</th>
					</tr>
					<?php 
						$queryList = "SELECT * FROM tbtarif ORDER BY Daya DESC";
						$queryList = $conn->query($queryList);
						$no = 1;
						while ($data = $queryList->fetch_assoc()) {
							?>
							<tr>
								<td><?= $no ?></td>
								<td><?= number_format($data['Daya']) ?> VA</td>
								<td>Rp. <?= number_format($data['TarifPerKwh'])  ?> / Kwh</td>
								<td>Rp. <?= number_format($data['Beban']) ?></td>
								<td>
									<div class="btn btn-edit">
										<a href="edit.php?id=<?= $data['KodeTarif'] ?>">Edit</a>
									</div> 
									<div class="btn btn-delete">
										<a href="delete.php?id=<?= $data['KodeTarif'] ?>">Delete</a>
									</div>
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
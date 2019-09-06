<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/operator.php';


	if (!isset($_GET['id'])) {
		header('location: ./index.php');
	}

	$id = $_GET['id'];
	$queryCheck = "SELECT * FROM tbtarif WHERE KodeTarif = '$id'";
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
 	<title>Edit Tarif</title>
 </head>
 <body>
 
 	<h1>Edit Tarif</h1>
 	<a href="../../dashboard/index.php">Dashboard</a>
 	<hr>

 	<form action="./process/edit-process.php" method="POST">
 		<input type="hidden" name="KodeTarif" value="<?= $data['KodeTarif'] ?>">
 		<table>
	 		<tr>
	 			<td>Daya</td>
	 			<td><input type="number" name="Daya" value="<?= $data['Daya'] ?>" min="1" required></td>
	 		</tr>
	 		<tr>
	 			<td>Tarif / Kwh</td>
	 			<td><input type="number" name="TarifPerKwh" value="<?= $data['TarifPerKwh'] ?>" min="1" required></td>
	 		</tr>
	 		<tr>
	 			<td>Beban</td>
	 			<td><input type="number" name="Beban" value="<?= $data['Beban'] ?>" min="1" required></td>
	 		</tr>
	 		<tr>
	 			<td><button type="submit" name="btn_submit">Update</button></td>
	 		</tr>
	 	</table>
 	</form>

 </body>
 </html>
<?php 
	require_once '../../../config/conn.php';
	require_once '../../../helper/alert.php';
	require_once '../../../helper/admin.php';
	if (isset($_POST['btn_submit'])) {
		$Daya = $conn->real_escape_string($_POST['Daya']);
		$TarifPerKwh = $conn->real_escape_string($_POST['TarifPerKwh']);
		$Beban = $conn->real_escape_string($_POST['Beban']);

		$queryInsert = "INSERT INTO tbtarif VALUES(NULL, '$Daya', '$TarifPerKwh', '$Beban')";
		$queryInsert = $conn->query($queryInsert);
		if ($queryInsert) {
			alert('Data Berhasil Ditambahkan', '../index.php', 'success');
		}
		else{
			alert('Data Gagal Ditambahkan', '../add.php', 'error');
		}
	}
	else{
		header('location: ../index.php');
	}
 ?>
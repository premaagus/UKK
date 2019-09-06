<?php 
	require_once '../../../config/conn.php';
	require_once '../../../helper/alert.php';
	require_once '../../../helper/admin.php';
	if (isset($_POST['btn_submit'])) {
		$KodeTarif = $conn->real_escape_string($_POST['KodeTarif']);
		$Daya = $conn->real_escape_string($_POST['Daya']);
		$TarifPerKwh = $conn->real_escape_string($_POST['TarifPerKwh']);
		$Beban = $conn->real_escape_string($_POST['Beban']);

		$queryUpdate = "UPDATE tbtarif SET Daya='$Daya', TarifPerKwh = '$TarifPerKwh', Beban = '$Beban' WHERE KodeTarif = $KodeTarif";
		$queryUpdate = $conn->query($queryUpdate);
		if ($queryUpdate) {
			alert('Data Berhasil Di Update', '../index.php', 'success');
		}
		else{
			alert('Data Gagal Di Update', '../edit.php', 'error');
		}
	}
	else{
		header('location: ../index.php');
	}
 ?>
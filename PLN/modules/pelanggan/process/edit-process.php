<?php 
	require_once '../../../config/conn.php';
	require_once '../../../helper/alert.php';
	require_once '../../../helper/admin.php';
	if (isset($_POST['btn_submit'])) {
		$KodePelanggan = $conn->real_escape_string($_POST['KodePelanggan']);
		$KodeTarif = $conn->real_escape_string($_POST['KodeTarif']);
		$NamaLengkap = $conn->real_escape_string($_POST['NamaLengkap']);
		$Telp = $conn->real_escape_string($_POST['Telp']);
		$Alamat = $conn->real_escape_string($_POST['Alamat']);

		$queryUpdate = "UPDATE tbpelanggan SET KodeTarif=$KodeTarif, NamaLengkap = '$NamaLengkap', Telp = '$Telp', Alamat = '$Alamat' WHERE KodePelanggan = $KodePelanggan ";
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
<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/admin.php';

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$queryCheck = "SELECT * FROM tblogin WHERE KodeLogin = '$id'";
		$queryCheck = $conn->query($queryCheck);

		if ($queryCheck->num_rows == 1) {
			$queryDelete = "DELETE FROM tblogin WHERE KodeLogin = '$id'";
			$queryDelete = $conn->query($queryDelete);
			if ($queryDelete) {
				alert('Data Berhasil Di Hapus', './index.php', 'success');
			}
			else{
				alert('Data Gagal Di Hapus', './index.php', 'error');
			}
		}
		else{
			alert('Data Tidak Ada', './index.php', 'error');
		}
	}
	else{
		header('location: ./index.php');
	}
 ?>
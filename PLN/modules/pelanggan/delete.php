<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/admin.php';

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$queryCheck = "SELECT * FROM tbpelanggan WHERE KodePelanggan = '$id'";
		$queryCheck = $conn->query($queryCheck);

		if ($queryCheck->num_rows == 1) {
			$data = $queryCheck->fetch_assoc();
			$NoPelanggan = $data['NoPelanggan'];
			$queryDelete = "DELETE FROM tbpelanggan WHERE KodePelanggan = '$id'";
			$queryDelete = $conn->query($queryDelete);
			if ($queryDelete) {
				$queryDelete1 = "DELETE FROM tblogin WHERE Username = '$NoPelanggan'";
				$queryDelete1 = $conn->query($queryDelete1);
				if ($queryDelete1) {
					alert('Data Berhasil Di Hapus', './index.php', 'success');
				}
				else{
					alert('Data User Gagal Di Hapus', './index.php', 'error');
				}
			}
			else{
				alert('Data Pelanggan Gagal Di Hapus', './index.php', 'error');
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